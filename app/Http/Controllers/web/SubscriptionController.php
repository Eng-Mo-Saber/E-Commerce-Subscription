<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index($id)
    {
        $categories = Category::all();
        $service = Service::find($id);
        return view('subscription.subscriptions' , compact( 'categories' , 'service'));
    }
    


}
