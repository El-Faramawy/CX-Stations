<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgetPassword\ConfirmCodeRequest;
use App\Http\Requests\Api\ForgetPassword\GetCodeRequest;
use App\Http\Requests\Api\ForgetPassword\UpdatePasswordRequest;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\SendEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    use SendEmail;
    use PaginateTrait;

    public function get_code(GetCodeRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $code = rand('100000', '999999');
        $user->update([
            'otp_code' => $code,
            'code_created_at' => date('Y-m-d H:i:s')
        ]);
        if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $this->sendEmailFun($user->email, $user->name, $code, setting()->name . " Email Verification Code ");
            return $this->apiResponse($user, 'تم ارسال الكود .', 'simple');
        } else {
            return $this->apiResponse(null, "البريد الالكترونى خطأ .", 'simple', 410);
        }
    }

    public function ConfirmCode(ConfirmCodeRequest $request)
    {
        $user = User::where('email', $request->email)->where('otp_code', $request->otp_code)->first();
        if ($user && $user->otp_code != null) {
            $codeSentTimeInTime = strtotime(date('Y-m-d H:i:s')) - strtotime($user->code_created_at);
            $codeSentTimeInMinutes = date('i', $codeSentTimeInTime);
            if ($codeSentTimeInMinutes >= 15) {
                return $this->apiResponse(null, "انتهت صلاحية الكود", 'simple', '410');
            }
            $user->otp_code = null;
            $user->status = 'active';
            $user->save();
            return $this->apiResponse($user, 'done', 'simple');
        } else {
            return $this->apiResponse(null, 'خطا فى الكود', 'simple', '422');
        }
    }

    public function UpdatePassword(UpdatePasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return $this->apiResponse($user, 'done', 'simple');
    }
}
