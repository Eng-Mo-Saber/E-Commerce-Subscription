<?php

namespace App\Http\Controllers\Api\Web\ResetPassword;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\ResetPassword;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    use ApiResponseTrait ;
    public function send_email(Request $request)
    {
        $email = $request->email;
        $request->validate([
            'email' => 'required|email'
        ]);
        $find_email = User::where('email', $email)->get()->toArray();
        if (!$find_email) {
            return $this->response_error('Email Not Found');
        } else {
            $token = Str::random(64);
            ResetPassword::updateOrCreate(
                ['email' => $email],
                ['token' => Hash::make($token)]
            );
            Mail::to($email)->send(new ResetPasswordMail($token , $email));
            return $this->response_success([ 'email'=>$email , 'token'=>$token ] ,'Email sent successfully');
        }
    }
}
