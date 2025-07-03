<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AccountDetailsController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $user = auth()->user();
        return view('auth.account-details' , compact('categories' , 'user'));
    }
}
