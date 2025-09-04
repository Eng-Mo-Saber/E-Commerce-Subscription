<?php

namespace App\Http\Controllers\Api\Web\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\Web\FavoritesResource;
use App\Models\Favorite;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $favorites = auth()->user()->favorites;
        return $this->response_success(['FavoriteProducts' => FavoritesResource::collection($favorites)]);
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
            
            return $this->response_success(null , 'Add Favorites Successfully' );
        } else {
            
            Favorite::where('product_id', $id)
            ->where('user_id', auth()->id())
            ->delete();
            return $this->response_success(null , 'The Product Already Exists' );
        }
    }
    
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();
        return $this->response_success(null , 'Delete Favorite Successfully');
    }
}
