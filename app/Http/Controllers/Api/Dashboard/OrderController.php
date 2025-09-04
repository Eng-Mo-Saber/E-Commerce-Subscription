<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Events\AcceptedOrderEvent;
use App\Events\UnAcceptedOrderEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Order_item;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return $this->response_success(['Orders'=>OrderResource::collection($orders)]);
    }
    
    public function accepted($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'shipped';
        $order->save();
        event(new AcceptedOrderEvent($id));
        return $this->response_success(['order'=>new OrderResource($order)] , "Order The Shipping" );
    }
    
    //رفض الاوردر
    public function unAccepted($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'rejected';
        $order->save();
        event(new UnAcceptedOrderEvent($order));
        return $this->response_success(['order'=>new OrderResource($order)] ,  "Order The UnAccepted");
    }
    
    public function details($id)
    {
        
        //بيجيب الاوردر ويعرض المنتجاتا اللي فيه
        $order = Order::findOrFail($id);
        $order_items = Order_item::where('order_id', $id)->get();
        return $this->response_success(['order'=>new OrderResource($order),'order_item'=>OrderItemResource::collection($order_items)]);
        

    }
}
