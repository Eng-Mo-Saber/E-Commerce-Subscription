<?php

namespace App\Http\Controllers\web;

use App\Events\RenewSubscriptionEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products_new = Product::latest()->take(10)->get();
        if (auth()->user()) {
            $favProductIds = auth()->user()->favorites->pluck('product_id')->toArray();
            return view('home', compact('products', 'favProductIds' ,'products_new'));
        }
        return view('home', compact('products' , 'products_new'));
    }

}
