<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class ShowUserSubscriptionsController extends Controller
{
    public function index()
    {
        $userSubscriptions = UserSubscription::all();
        $payments = Payment::all();
        return view('dashboard.subscription.showUserSubscription' , compact('userSubscriptions' , 'payments'));
    }
}
