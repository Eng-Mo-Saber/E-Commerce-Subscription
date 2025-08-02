<?php

namespace App\Http\Controllers\Api\Web\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryWebController extends Controller
{
    public function index(){
        $category = Category::all();
        return response()->json(CategoryResource::collection($category));
    }
}
