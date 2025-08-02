<?php

namespace App\Http\Controllers\Api\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\Payment;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class PaymentInvoiceController extends Controller
{
    public function show($id)
    {
        $userSubscription = UserSubscription::find($id);
        $payment = Payment::find($userSubscription->payment_id);
        return response()->json(['userSubscription'=> new UserSubscriptionResource($userSubscription) , 'payment_id'=>$payment->id ]);
    }
}
