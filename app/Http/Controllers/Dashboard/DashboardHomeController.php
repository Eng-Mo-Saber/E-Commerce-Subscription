<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class DashboardHomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $orders = Order::all();
        $user_subscriptions = UserSubscription::all();
        $payments = Payment::all();
        return view('dashboard.index' , compact('users' , 'orders', 'user_subscriptions' , 'payments'));
    }
}
