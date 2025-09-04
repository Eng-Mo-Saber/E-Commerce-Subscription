<?php

namespace App\Http\Controllers\Api\Web\ResetPassword;

use App\Http\Controllers\Controller;
use App\Mail\SuccessResetPasswordMail;
use App\Models\ResetPassword;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    use ApiResponseTrait ;
    public function index($token, $email)
    {
        $reset_password = ResetPassword::where('email', $email)->first();
        // لو مفيش إيميل أصلاً
        if (!$reset_password) {
            return abort(404, 'Invalid link');
        }

        // تحقق من التوكن
        if (!Hash::check($token, $reset_password->token)) {
            return abort(403, 'The link is invalid or expired');
        }
        return $this->response_success(['email' => $email] , 'Go End Point ResetPassword Page');
    }

    public function reset_password(Request $request)
    {
        $email = $request->email;
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8'
        ]);

        if ($request->password == $request->confirm_password) {
            $user = User::where('email', $email)->first();
            if (!$user) {
                return $this->response_error('User not found.', 404);
            }
            $user->password = Hash::make($request->password);
            $user->save();

            $reset = ResetPassword::where('email', $email)->first();
            $reset->delete();
            Mail::to($email)->send(new SuccessResetPasswordMail($user));
            return $this->response_success(null , 'تم تغيير كلمة المرور بنجاح ‘ قم بتسجيل الدخول الان');
        }
    }
}
