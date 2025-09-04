<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\Payment;
use App\Models\UserSubscription;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userSubscriptions = UserSubscription::all();
        return $this->response_success(['UserSubscriptions'=>UserSubscriptionResource::collection($userSubscriptions)]);
    }
    
    /**
     * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $userSubscription = UserSubscription::findOrFail($id);
        $payment = Payment::findOrFail($userSubscription->payment_id);
        return $this->response_success(['UserSubscriptions'=>new UserSubscriptionResource($userSubscription) , 'PaymentId'=>$payment->id]);
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
        //
    }
}
