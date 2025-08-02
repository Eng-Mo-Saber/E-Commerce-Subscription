<?php

namespace App\Http\Controllers\Api\Web\ResetPassword;

use App\Http\Controllers\Controller;
use App\Mail\SuccessResetPasswordMail;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
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
        return response()->json(['email' => $email, 'massage' => 'Go End Point ResetPassword Page'], 200);
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
                return response()->json(['error' => 'User not found.'], 404);
            }
            $user->password = Hash::make($request->password);
            $user->save();

            $reset = ResetPassword::where('email', $email)->first();
            $reset->delete();
            Mail::to($email)->send(new SuccessResetPasswordMail($user));
            return response()->json(['massage' => 'تم تغيير كلمة المرور بنجاح ‘ قم بتسجيل الدخول الان']);
        }
    }
}
