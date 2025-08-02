<?php

namespace App\Http\Controllers\Api\Web\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TrackOrderController extends Controller
{
    public function show_status_order(Request $request)
    {
        $id = $request->id ;
        $order= Order::find($id);
        if(!$order){
            return response()->json(['error'=>'الطلب غير موجود']);
        }elseif($order->status == 'pending'){
            return response()->json(['success'=>'الطلب قيد الانتظار']);
        }elseif($order->status == 'shipped'){
            return response()->json(['success'=>'تم شحن الطلب']);
        }elseif($order->status == 'completed'){
            return response()->json(['success'=>'تم استلام الطلب']);
        }else{
            return response()->json(['success'=>'تم رفض الطلب لعدم صحة العنوان']);
        }
        

    }
}
