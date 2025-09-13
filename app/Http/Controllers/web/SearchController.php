<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $results = Product::where('name', 'LIKE', "%{$q}%")->get();

        return view('search.results', [
            'results' => $results,
            'query'   => $q
        ]);
    }
}
