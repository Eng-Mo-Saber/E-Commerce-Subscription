<?php

namespace App\Http\Controllers\Auth;

use App\Events\RenewSubscriptionEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('auth.login', compact('categories'));
    }
    public function login(Request $request)
    {
        // validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('page.dashboard');
            }
            return redirect()->route('home.page');
        } else {
            return redirect()->route('login.page')->with('error', 'البريد الالكتروني او كلمة المرور غير صحيحة');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.page');
    }
}
