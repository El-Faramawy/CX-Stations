<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\Auth\LoginRequest;
use App\Http\Requests\Brand\Auth\RegisterRequest;
use App\Http\Traits\SendEmail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use SendEmail;

    public function index()
    {
        if (brand()->check()) {
            return redirect('brand/home');
        }
        return view('Brand.login');
    }

    public function login(LoginRequest $request)
    {
        if (brand()->attempt(['email' => request('email'), 'password' => request('password')])) {
            if (brand()->user()->verified !== 1) {
                $this->sendRegisterMail(brand()->user());
                $email = brand()->user()->email;
                brand()->logout();
                return response()->json(['message' => __('validation.activate_account'), 'url' => route('brand.get_confirm_code', ['email' => $email])]);
            }
            if (brand()->user()->status !== 'active') {
                brand()->logout();
                return response()->json(['errors' => [__('validation.account_not_active')]], 500);
            }
            return response()->json(['message' => __('validation.logged_in_successfully'), 'url' => route('brand.home')]);
        } else {
            return response()->json(['errors' => [__('validation.incorrect_password')]], 500);
        }
    }

    public function register()
    {
        if (brand()->check()) {
            return redirect('brand/home');
        }
        $countries = Country::all();
        $categories = Category::all();
        return view('Brand.register', compact( 'categories','countries'));
    }

    public function post_register(RegisterRequest $request)
    {
        $data = $request->only('name', 'email', 'phone', 'country_id','city_id', 'category_id', 'commercial_number');
        $data['password'] = Hash::make($request->password);
        $data['phone_code'] = Country::where('id',$request->country_id)->first()?->code;
        $brand = Brand::create($data);
//        brand()->login($brand);
        $this->sendRegisterMail($brand);
        my_toaster(__('validation.registered_successfully'));
        $route = route('brand.get_confirm_code', ['email' => $brand->email]);
        return response()->json(['url' => $route]);
//        return response()->json(['message' => 'Registered Successfully , wait for activation', 'reset_form' => 'true'], 200);
    }

    public function sendRegisterMail($brand)
    {
        $code = rand('100000', '999999');
        $brand->update([
            'otp_code' => $code,
            'code_created_at' => date('Y-m-d H:i:s')
        ]);
        if (filter_var($brand->email, FILTER_VALIDATE_EMAIL)) {
            $this->sendEmailFun($brand->email, $brand->name, $code, setting()->name . " Email Verification Code ");
        }
        return response()->json(['message' => __('validation.email_sent')]);
    }

    public function logout()
    {
        brand()->logout();
        my_toaster(__('validation.logged_out_successfully'), 'warning');
        return redirect('brand/login');
    }

    public function get_country_cities(Request $request)
    {
        $cities = City::where('country_id',$request->country_id)->get();
        return response()->json($cities);
    }

}
