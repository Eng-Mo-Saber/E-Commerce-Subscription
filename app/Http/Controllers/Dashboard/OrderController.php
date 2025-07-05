<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\AcceptedOrderEvent;
use App\Events\UnAcceptedOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('user_id' , auth()->user()->id)->get();
        return view('dashboard.order.showOrders' , compact('orders'));
    }

    public function accepted($id){
        $order = Order::find($id);
        $order->status ='shipped';
        $order->save();
        event(new AcceptedOrderEvent($id));

        return redirect()->route('dashboard.showOrders')->with('success' , "Order The Shipping");
    }

    //رفض الاوردر
    public function unAccepted($id){
        $order = Order::find($id);
        $order->status ='rejected';
        $order->save();
        event(new UnAcceptedOrderEvent($order));

        return redirect()->route('dashboard.showOrders')->with('success' , "Order The UnAccepted");
    }
    
    public function details($id){

        //بيجيب الاوردر ويعرض المنتجاتا اللي فيه
        $order = Order::find($id);
        $order_items = Order_item::where('order_id' , $id)->get();

        
        return view('dashboard.order.detailsOrder' ,compact('order' , 'order_items'));
    }

}
