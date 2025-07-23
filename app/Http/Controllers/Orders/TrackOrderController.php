<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class TrackOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('order.track-order' );
    }

    public function show_status_order(Request $request)
    {
        $id = $request->id ;
        $order= Order::find($id);
        if(!$order){
            return back()->with('error' , 'الطلب غير موجود');
        }elseif($order->status == 'pending'){
        return back()->with('success' , 'الطلب قيد الانتظار');
        }elseif($order->status == 'shipped'){
            return back()->with('success' , 'تم شحن الطلب');
        }elseif($order->status == 'completed'){
            return back()->with('success' , 'تم استلام الطلب');
        }else{
            return back()->with('error' , 'تم رفض الطلب لعدم صحة العنوان');
        }
        

    }

}
