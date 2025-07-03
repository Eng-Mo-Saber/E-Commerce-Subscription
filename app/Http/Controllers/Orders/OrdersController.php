<?php

namespace App\Http\Controllers\Orders;

use App\Events\AddOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $orders = Order::where('user_id' , auth()->user()->id)->get();
        return view('order.orders', compact('categories' , 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation لل address and notes
        $request->validate([
            'address'=>'required|string|max:255',
            'notes'=>'nullable|string|max:255',
        ]);
        //جاب الللى في الكارت وجاب المنتجات كلها
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $products = Product::all();
        $total = 0;

        foreach ($carts as $cart) {
            //حساب مجموع كل المنتجات
            $total += $cart->product->price * $cart->quantity;
            foreach ($products as $product) {
                if ($product->id == $cart->product_id) {
                    //مقارنه عشان نشوف الكميه الطلوبه متوفره ام لا
                    if ($product->stock_quantity < $cart->quantity) {
                        //لو غير كافيه هيطلع ايرور
                        return redirect()->route('cart.page')->with('error', ' العدد المتبقي في المخزوم هو : '. $product->stock_quantity . ' فقط لهذا المنتج : ' . $product->name);
                    } else {
                        //لو كافيه هينقصها من المخزن
                        $product->stock_quantity  -= $cart->quantity;
                        $product->save();
                    }
                }
            }
        }
        //ينشي اوردر
        $Order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'address' => $request->address,
            'notes' => $request->notes,
            'total_price' => $total,
        ]);
        //ينشي اوردر ايتم يضيف فيه كل المنتجات اللي في الاوردر
        foreach ($carts as $cart) {
            Order_item::create([
                'order_id' => $Order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price
            ]);
            //بعد ما يضي يحذف الكارت عشان يضيف لو هيضيف تاني
            $cart->delete();
        }
    
        event(new AddOrderEvent($Order->id));

        return redirect()->route('home.page')->with('success', 'تم انشاء الطلب بنجاح');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        
        return back()->with('success' , 'تم إلغاء الطلب بنجاح');
    }
}
