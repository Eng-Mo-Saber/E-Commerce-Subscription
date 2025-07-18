<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('auth.profile', compact('categories'));
    }
}
