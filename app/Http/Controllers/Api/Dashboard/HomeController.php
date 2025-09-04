<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserSubscription;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    use ApiResponseTrait;
    public function index()
    {
        $users = User::count();
        $orders = Order::count();
        $user_subscriptions = UserSubscription::count();
        $payments = Payment::count();
        return $this->response_success(['count_user'=>$users ,'count_orders'=>$orders ,
         'count_user_subscriptions'=>$user_subscriptions, 'count_payments'=>$payments ]);
    }
}
