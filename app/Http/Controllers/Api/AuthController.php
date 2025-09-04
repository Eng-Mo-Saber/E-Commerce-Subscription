<?php

namespace App\Http\Controllers\Api;

use App\Events\UserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'customer',
            'password' => Hash::make($request->password),
        ]);

        //event Welcome Mail
        event(new UserRegisterEvent($user));
        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->response_success(['token'=>$token , 'user'=>new UserResource($user)] , "Register User Success");
    }
    
    public function login(Request $request)
    {
        // validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            if ($user->role == 'admin') {
                return $this->response_success(['token'=>$token , 'user'=>new UserResource($user)] , "Login Admin Success , Go to Dashboard");
                
            }
            return $this->response_success(['token'=>$token , 'user'=>new UserResource($user)] , "Login Customer Success , Go to Home");
        } else {
            return $this->response_error(['البريد الالكتروني او كلمة المرور غير صحيحة'] , 401);
        }
    }
    
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->response_success(null , "LogOut From Web");


    }
}
