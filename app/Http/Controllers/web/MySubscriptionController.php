<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MySubscriptionController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $userId = Auth::id();
        // كل الاشتراكات اللي المستخدم مشترك فيها مع الاشتراك المرتبط
        $userSubscriptions = UserSubscription::with('subscription')->where('user_id', $userId)->get();
        return view('subscription.mySubscriptions', compact('categories', 'userSubscriptions'));
    }
}
