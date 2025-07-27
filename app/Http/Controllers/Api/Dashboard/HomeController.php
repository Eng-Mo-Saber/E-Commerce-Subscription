<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $users = User::count();
        $orders = Order::count();
        $user_subscriptions = UserSubscription::count();
        $payments = Payment::count();
        return response()->json(['count_user'=>$users ,'count_orders'=>$orders ,
         'count_user_subscriptions'=>$user_subscriptions, 'count_payments'=>$payments ]);
    }
}
