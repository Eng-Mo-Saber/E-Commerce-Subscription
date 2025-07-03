<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SingleCategoryController extends Controller
{
    public function index($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->get();
        if (auth()->user()) {
            $favProductIds = auth()->user()->favorites->pluck('product_id')->toArray();
            return view('single-category', compact('products', 'categories', 'favProductIds'));
        }
        return view('single-category', compact('products', 'categories'));
    }
}
