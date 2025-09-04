<?php

namespace App\Http\Controllers\Api\Web\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryWebController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $category = Category::all();
        return $this->response_success(['Categories'=>CategoryResource::collection($category)]);
    }
}
