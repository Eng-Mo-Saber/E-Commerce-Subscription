<?php

namespace App\Http\Controllers\Api\Web\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class TrackOrderController extends Controller
{
    use ApiResponseTrait ;
    public function show_status_order(Request $request)
    {
        $id = $request->id ;
        $order= Order::find($id);
        if(!$order){
            return $this->response_error('الطلب غير موجود');
        }elseif($order->status == 'pending'){
            return $this->response_success(null ,'الطلب قيد الانتظار');
        }elseif($order->status == 'shipped'){
            return $this->response_success(null ,'تم شحن الطلب');
        }elseif($order->status == 'completed'){
            return $this->response_success(null ,'تم استلام الطلب');
        }else{
            return $this->response_success(null ,'تم رفض الطلب لعدم صحة العنوان');
        }
        

    }
}
