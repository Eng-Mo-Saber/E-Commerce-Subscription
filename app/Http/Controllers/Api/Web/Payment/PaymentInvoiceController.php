<?php

namespace App\Http\Controllers\Api\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\Payment;
use App\Models\UserSubscription;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PaymentInvoiceController extends Controller
{
    use ApiResponseTrait ;
    public function show($id)
    {
        $userSubscription = UserSubscription::find($id);
        $payment = Payment::find($userSubscription->payment_id);
        return $this->response_success(['userSubscription'=> new UserSubscriptionResource($userSubscription) , 'payment_id'=>$payment->id ]);
    }
}
