<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('cart', compact('carts' ));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $check_addCart = true;
        $product = Product::find($id);
        $old_carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($old_carts as $cart) {
            if ($cart['product_id'] == $product->id) {
                $cart->quantity += $request->quantity;
                $cart->save();
                $check_addCart = false;
                return redirect()->route('home.page')->with('success', 'تم اضافة المنتج بنجاح');
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


        return redirect()->route('home.page')->with('success', 'تم اضافة المنتج الي السلة بنجاح');
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('cart.page')->with('success', 'تم حذف المنتج من السلة بنجاح');
    }
}
