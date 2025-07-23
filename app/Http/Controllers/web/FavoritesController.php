<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites;
        return view('favorites' , compact( 'favorites'));
    }
    public function add_favorite($id){
        Favorite::create([
            'product_id' => $id,
            'user_id' => auth()->user()->id,
        ]);
        return back();
    }

    public function destroy($id)
    {
        $favorite = Favorite::find($id);
        $favorite->delete();
        return redirect()->route('favorites.page')->with('success', 'Delete Favorite Successfully');
    }
}
