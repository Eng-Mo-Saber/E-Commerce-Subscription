<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('branches' , compact('categories'));
    }
}
