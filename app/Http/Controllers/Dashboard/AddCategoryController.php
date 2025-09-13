<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AddCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.showCategories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.addCategory');
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
        return redirect()->route('dashboard.addCategory')->with('success', 'Add Category Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 1 || $id == 2) {
            return redirect()->route('dashboard.showCategories')->with('error', 'Can\'t Update This Category');
        }
        $category = Category::find($id);
        return view('dashboard.category.updateCategory', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $Category = Category::find($id);
        $request->validate([
            'name' => "required|string|max:255",
        ]);
        $Category->update([
            'name' => $request->name,
        ]);
        return redirect()->route('dashboard.showCategories')->with('success', 'Update Category Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1 || $id == 2) {
            return redirect()->route('dashboard.showCategories')->with('error', 'Can\'t Delete This Category');
        }
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('dashboard.showCategories')->with('success', 'Delete Category Successfully');
    }
}
