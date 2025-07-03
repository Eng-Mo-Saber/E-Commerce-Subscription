<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('auth.register' , compact('categories'));
    }

    public function store(Request $request)
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


        return redirect()->route('home.page');
    }
}
