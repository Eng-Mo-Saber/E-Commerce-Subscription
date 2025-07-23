<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
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
        //لو كله تمام هيعرضلي الصفحه
        return view('auth.reset-password' , compact('email'));
    }

    public function reset_password(Request $request){
        $email = $request->email ;
        $request->validate([
            'password'=>'|min:8',
            'confirm_password'=>'required|min:8'
        ]);
        
        if($request->password == $request->confirm_password){
            $user = User::where('email' , $email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            $reset = ResetPassword::where('email' , $email)->first();
            $reset->delete();
            Mail::to($email)->send(new SuccessResetPasswordMail($user));
            return view('auth.login')->with('success' , 'تم تغيير كلمة المرور بنجاح ‘ قم بتسجيل الدخول الان');
        }
    }
}
