<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\Web\ProductsHomeResource;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class HomeWebController extends Controller
{
    use ApiResponseTrait;
    public function noAuth()
    {
        $products = Product::all();
        $products_new = Product::latest()->take(10)->get();
        return $this->response_success([ 'Products_new' => ProductsHomeResource::collection($products_new) ,'Products' => ProductsHomeResource::collection($products) ]);
    }
    public function auth()
    {
        $products = Product::all();
        $products_new = Product::latest()->take(10)->get();
        $favProductIds = auth()->user()->favorites->pluck('product_id')->toArray();
        return $this->response_success(['Products_new' => ProductsHomeResource::collection($products_new) ,'Products' => ProductsHomeResource::collection($products), 'favProductIds' => $favProductIds]);
    }
}
