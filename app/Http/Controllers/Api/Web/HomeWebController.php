<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\Web\ProductsHomeResource;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeWebController extends Controller
{
    public function noAuth()
    {
        $products = Product::all();
        return response()->json(['products' => ProductsHomeResource::collection($products)]);
    }
    public function auth()
    {
        $products = Product::all();
        $favProductIds = auth()->user()->favorites->pluck('product_id')->toArray();
        return response()->json(['products' => ProductsHomeResource::collection($products), 'favProductIds' => $favProductIds]);
    }
}
