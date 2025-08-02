<?php

namespace App\Http\Controllers\Api\Web\Cart;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        return response()->json(['products'=>CartResource::collection($carts)] , 200);
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $check_addCart = true;
        $product = Product::findOrFail($id);
        $old_carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($old_carts as $cart) {
            if ($cart['product_id'] == $product->id) {
                $cart->quantity += $request->quantity;
                $cart->save();
                $check_addCart = false;
                return response()->json(['massage'=>'تم اضافة المنتج بنجاح']);
            }
        }
        if ($check_addCart) {
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
        }
        
        return response()->json(['massage'=>'تم اضافة المنتج الي السلة بنجاح']);
    }
    
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json(['massage'=>'تم حذف المنتج من السلة بنجاح']);
    }
}
