<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return $this->response_success( ['Categories'=>CategoryResource::collection($categories)]);
    }
    
    /**
     * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255",
        ]);
        $category = Category::create([
            'name' => $request->name,
        ]);
        return $this->response_success( ['Category'=>new CategoryResource($category)] , "Add Category Successfully");
    }
    
    /**
     * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $request->validate([
            'name'=>"required|string|max:255",
        ]);
        $category->update([
            'name'=>$request->name,
        ]);
        return $this->response_success( ['Category'=>new CategoryResource($category)] , "Update Category Successfully");
    }
    
    /**
     * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $this->response_success( null , "Delete Category Successfully");
    }
}
