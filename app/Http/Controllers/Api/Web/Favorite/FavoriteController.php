<?php

namespace App\Http\Controllers\Api\Web\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\Web\FavoritesResource;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function index()
    {
        $favorites = auth()->user()->favorites;
        return response()->json(['favoriteProducts' => FavoritesResource::collection($favorites)], 200);
    }
    public function add_favorite($id)
    {

        $product = Product::findOrFail($id);

        $exists = Favorite::where('product_id', $id)
            ->where('user_id', auth()->id())
            ->exists();

        if (!$exists) {
            Favorite::create([
                'product_id' => $id,
                'user_id' => auth()->id(),
            ]);

            return response()->json(['massage' => 'Add Favorites Successfully']);
        } else {

            Favorite::where('product_id', $id)
                ->where('user_id', auth()->id())
                ->delete();

            return response()->json(['massage' => 'The Product Already Exists']);
        }
    }
    
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();
        return response()->json(['massage' => 'Delete Favorite Successfully']);
    }
}
