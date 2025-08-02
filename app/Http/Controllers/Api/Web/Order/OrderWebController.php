<?php

namespace App\Http\Controllers\Api\Web\Order;

use App\Events\AddOrderEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\OrderDetailsResource;
use App\Http\Resources\Web\OrderItemsResource;
use App\Http\Resources\Web\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return response()->json(OrderResource::collection($orders));
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
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
        ]);
        //جاب الللى في الكارت وجاب المنتجات كلها
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $products = Product::all();
        $total = 0;
        $check = !Cart::where('user_id', auth()->id())->exists();

        if(!$check) {
            dd(123);
            foreach ($carts as $cart) {
                //حساب مجموع كل المنتجات
                $total += $cart->product->price * $cart->quantity;
                foreach ($products as $product) {
                    if ($product->id == $cart->product_id) {
                        //مقارنه عشان نشوف الكميه الطلوبه متوفره ام لا
                        if ($product->stock_quantity < $cart->quantity) {
                            //لو غير كافيه هيطلع ايرور
                            return response()->json(['error' => ' العدد المتبقي في المخزوم هو : ' . $product->stock_quantity . ' فقط لهذا المنتج : ' . $product->name]);
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
            return response()->json(['orderId' => $Order->id, 'success' => 'تم انشاء الطلب بنجاح']);
        } else {

            return response()->json(['error' => 'السلة فارغه اضف المنتجات']);
        }
    }

    /**
     * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $order = Order::find($id);
        $order_items = Order_item::where('order_id' , $id)->get();
        return response()->json(['order'=>new OrderDetailsResource($order) , 'order_items' => OrderItemsResource::collection($order_items)]);
        
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
        $order = Order::findOrFail($id);
        if($order->status == 'pending'){
            $order->delete();
            return response()->json(['success' =>'تم إلغاء الطلب بنجاح']);
        }else{
            return response()->json(['error' =>'لا يمكن الغاء الطلب ‘ تم شحنه بالفعل']);

        }
        
    }
}
