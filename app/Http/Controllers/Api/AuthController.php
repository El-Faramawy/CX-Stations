<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentication\LoginRequest;
use App\Http\Requests\Api\Authentication\LogoutRequest;
use App\Http\Requests\Api\Authentication\RegisterRequest;
use App\Http\Requests\Api\Authentication\UpdateProfileRequest;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\PhotoTrait;
use App\Http\Traits\SendEmail;
use App\Models\PhoneToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use PhotoTrait;
    use PaginateTrait;
    use SendEmail;

    public function login(LoginRequest $request)
    {
        try {
            $data = $request->only('email', 'password', 'fcm_token');
            $credentials = ['email' => $data['email'], 'password' => $data['password']];
            $token = user_api()->attempt($credentials);
            if ($token) {
                if (user_api()->user()->status === 'pending') {
                    $this->sendRegisterMail(user_api()->user());
                    user_api()->logout();
                    return $this->apiResponse(null, 'لم يتم تاكيد البريد الالكترونى , تم ارسال كود التاكيد على بريدك الالكترونى ',
                        'simple', '409');
                }
                if (user_api()->user()->status === 'not_active') {
                    user_api()->logout();
                    return $this->apiResponse(null, 'حسابك غير مفعل ', 'simple', '410');
                }
                $user = User::where('id', user_api()->user()->id)->first();
                $user->token = $token;
                PhoneToken::updateOrCreate([
                    'user_id' => $user->id,
                    'phone_token' => $data['fcm_token'],
                ]);
                return $this->apiResponse($user, '', 'simple');
            } else {
                return $this->apiResponse(null, 'خطا فى البيانات  ', 'simple', '422');
            }

        } catch (\Exception $ex) {
            return $this->apiResponse($ex->getCode(), $ex->getMessage(), 'simple', '422');
        }

    }

    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->except('fcm_token', 'password', 'status', 'points', 'otp_code');
            $data['password'] = Hash::make($request->password);
//            $data['status'] = 'active'; // test status
            $data['status'] = 'pending';
            $data['points'] = 100;
            $user = User::create($data);

            $this->sendRegisterMail($user);

            $token = user_api()->login($user);
            $user = User::where('id', $user->id)->first();
            $user->token = $token;

            PhoneToken::updateOrCreate([
                'user_id' => $user->id,
                'phone_token' => $request->fcm_token,
            ]);

            return $this->apiResponse($user, '', 'simple');

        } catch (\Exception $ex) {
            return $this->apiResponse($ex->getCode(), $ex->getMessage(), 'simple', '422');
        }

    }

    public function sendRegisterMail($user)
    {
        $code = rand('100000', '999999');
        $user->update([
            'otp_code' => $code,
            'code_created_at' => date('Y-m-d H:i:s')
        ]);
        if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $this->sendEmailFun($user->email, $user->name, $code, setting()->name . " Email Verification Code ");
        }
    }

    public function profile()
    {
        $user = User::with('city:id,name_ar,name_en')->where('id', user_api()->id())->withCount('follow')->first();
        $user->token = getToken();
        return $this->apiResponse($user, '', 'simple');
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $data = $request->except('password', 'image', 'phone');
        if ($request->password && $request->password != null) {
            $data['password'] = Hash::make($request->password);
        }
        $user = User::where('id', user_api()->user()->id)->first();
        if (isset($request->image))
            $data['image'] = $this->saveImage($request->image, 'uploads/user', $user->getAttributes()['image']);

        $user->update($data);
        $user->token = getToken();

        return $this->apiResponse($user, '', 'simple');

    }

    public function logout(LogoutRequest $request)
    {

        if (!\user_api()->check()) {
            return $this->apiResponse(null, 'logout once or token is not valid', 'simple');
        }

        PhoneToken::where(['user_id' => user_api()->id(), 'phone_token' => $request->token])->delete();

        user_api()->logout();
        return $this->apiResponse(null, 'done', 'simple');
    }


}
