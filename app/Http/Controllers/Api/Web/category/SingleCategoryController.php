<?php

namespace App\Http\Controllers\Api\Web\category;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\Web\ProductsHomeResource;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SingleCategoryController extends Controller
{
    use ApiResponseTrait;
    public function indexNoAuth($id)
    {
        $products = Product::where('category_id', $id)->get();
        return $this->response_success(['products' => ProductsHomeResource::collection($products)]);
    }
    
    public function indexAuth($id)
    {
        $products = Product::where('category_id', $id)->get();
        $favProductIds = auth()->user()->favorites->pluck('product_id')->toArray();
        return $this->response_success(['products' => ProductsHomeResource::collection($products) , 'favProductIds' => $favProductIds]);
    }
}

