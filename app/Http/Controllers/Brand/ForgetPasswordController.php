<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\ForgetPassword\ConfirmCodeRequest;
use App\Http\Requests\Brand\ForgetPassword\GetCodeRequest;
use App\Http\Requests\Brand\ForgetPassword\UpdatePasswordRequest;
use App\Http\Traits\SendEmail;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    use SendEmail;

    public function get_code(GetCodeRequest $request)
    {
        $user = Brand::where('email', $request->email)->first();
        $code = rand('100000', '999999');
        $user->update([
            'otp_code' => $code,
            'code_created_at' => date('Y-m-d H:i:s')
        ]);
        if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $this->sendEmailFun($user->email, $user->name, $code, setting()->name . " Email Verification Code ");
            return response()->json([
                'message' => 'Code sent , check your email inbox',
                'reset_form' => 'true',
                'url' => route('brand.get_confirm_code', ['email' => $user->email])
            ]);
        } else {
            return response()->json(['messages' => ['Incorrect Email']], 422);
        }
    }

    public function GetConfirmCode(Request $request)
    {
        return view('Brand.code-verification', ['email' => $request->email]);
    }

    public function ConfirmCode(ConfirmCodeRequest $request)
    {
        $brand = Brand::where('email', $request->email)->where('otp_code', $request->otp_code)->first();
        $brandOldVerifiedValue = $brand->verified;
        if ($brand && $brand->otp_code != null) {
            $codeSentTimeInTime = strtotime(date('Y-m-d H:i:s')) - strtotime($brand->code_created_at);
            $codeSentTimeInMinutes = date('i', $codeSentTimeInTime);
            if ($codeSentTimeInMinutes >= 15) {
                return response()->json(['messages' => ['Code Expired']], 422);
            }
            $brand->otp_code = null;
            $brand->verified = 1;
            $brand->save();
            if ($brandOldVerifiedValue !== 1) {
                return response()->json(['message' => 'Email Confirmed Successfully', 'url' => route('brand.success')]);
            }
            else {
                return response()->json(['message' => 'Code Confirmed Successfully', 'url' => route('brand.get_update_password', ['email' => $brand->email])]);
            }
        } else {
            return response()->json(['messages' => ['Wrong code']], 422);
        }
    }

    public function getUpdatePassword(GetCodeRequest $request)
    {
        return view('Brand.update-password', ['email' => $request->email]);
    }

    public function UpdatePassword(UpdatePasswordRequest $request)
    {
        $brand = Brand::where('email', $request->email)->first();
        if ($brand->verified !== 1) {
            return response()->json(['messages' => ['Not Verified Email']], 422);
        }
        $brand->update([
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['message' => 'Password Updated Successfully', 'url' => route('brand.login')]);
    }

}
