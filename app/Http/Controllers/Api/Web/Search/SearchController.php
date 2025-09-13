<?php

namespace App\Http\Controllers\Api\Web\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ProductsHomeResource;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use ApiResponseTrait ;
    public function index(Request $request)
    {
        $q = $request->input('q');

        $results = Product::where('name', 'LIKE', "%{$q}%")->get();

        return $this->response_success( [
            'results' => ProductsHomeResource::collection($results),
            'query'   => $q
        ]);
    }


}
