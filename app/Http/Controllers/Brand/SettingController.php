<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        $discount_points_last_updated = $discount_last_updated= true;
        if (brand()->user()->discount_points_last_updated && brand()->user()->discount_points_last_updated > Carbon::now()->subMonth()) {
            $discount_points_last_updated = false;
        }
        if (brand()->user()->discount_last_updated && brand()->user()->discount_last_updated > Carbon::now()->subMonth()) {
            $discount_last_updated = false;
        }

            return view('Brand.settings',compact('discount_points_last_updated','discount_last_updated'));
    }

    public function post_setting(Request $request)
    {
        $data = $request->except('email','phone','name','commercial_number','category_id',
            'password','current_password','confirm_password','address');
        if ( $request->image && $request->image != null ){
            $data['image']    = $this->saveImage($request->image,'uploads/brand',brand()->user()->image);
        }
        if ( $request->panner && $request->panner != null ){
                $data['panner']    = $this->saveImage($request->panner,'uploads/brand',brand()->user()->panner);
        }
        if (isset($request->password) && $request->password != null) {
            if (!Hash::check($request->current_password, brand()->user()->password)) {
                return response()->json(['messages' => [__('validation.incorrect_current_password')]], 422);
            }
            $validator = Validator::make($request->all(), [
                'password' => 'required_with:confirm_password|same:confirm_password|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'confirm_password' => 'required'
            ], [
                'password.required_with' => __('validation.password_required_with'),
                'password.same' => __('validation.password_same'),
                'password.min' => __('validation.password_min'),
                'password.regex' => __('validation.password_help'),
                'confirm_password.required' => __('validation.confirm_password_required'),
            ]);
            if ($validator->fails())
                return response()->json(['messages' => $validator->errors()->getMessages()], 422);

            $data['password'] = Hash::make($request->password);
        }
        $reload = false;
        if (isset($request->discount_points) && $request->discount_points != brand()->user()->discount_points) {
            $data['discount_points_last_updated'] = now();
            $reload = true;
        }
        if (isset($request->discount) && $request->discount != brand()->user()->discount) {
            $data['discount_last_updated'] = now();
            $reload = true;
        }
        brand()->user()->update($data);
        if ($reload){
            return response()->json(['message' => __('validation.data_updated'), 'url' => route('brand.settings')], 200);
        }
        return response()->json(['message' => __('validation.data_updated')], 200);
    }

}
