<?php

namespace App\Http\Controllers\web;

use App\Events\UserSubscriptionEvent;
use App\Http\Controllers\Controller;
use App\Mail\SendSubscriptionMail;
use App\Mail\SubscriptionMail;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id)
    {
        $categories = Category::all();
        $subscription = Subscription::findOrFail($id);
        return view('subscription.payment', compact('subscription' , 'categories'));
    }
    public function store(Request $request)
    {
        $check_date = 0 ; 
        if($request->type_payment == 'cash'){
            $request->validate([
                'subscription_id'=>"required",
                'auto_renew'=>"required|boolean",
                'type_payment'=>"required|string",
                'cash_number'=>"required|string|min:11|max:11",
                'card_number'=>"nullable|string|min:16|max:16",
                'card_end_date'=>"nullable|date_format:Y-m",
                'card_CVV'=>"nullable|string|min:3|max:3",
                
            ]);
            $check_date = 1 ;
        }else{
            $request->validate([
                'subscription_id'=>"required",
                'auto_renew'=>"required|boolean",
                'type_payment'=>"required|string",
                'cash_number'=>"nullable|string|min:11|max:11",
                'card_number'=>"required|string|min:16|max:16",
                'card_end_date'=>"required|date_format:Y-m",
                'card_CVV'=>"required|string|min:3|max:3",
                
            ]);
            
        }
        if($check_date){
        $card_end_date = $request->card_end_date;
        }else{
        $card_end_date =$request->card_end_date.'-01';
        }

        $Payment = Payment::create([
            'type_payment'=>$request->type_payment,
            'cash_number'=>$request->cash_number,
            'card_number'=>$request->card_number,
            'card_end_date'=>$card_end_date,
            'card_CVV'=>$request->card_CVV,
        ]);

        $subscription = Subscription::findOrFail($request->subscription_id);
        $user_subscription = UserSubscription::create([
            'user_id'=>auth()->user()->id,
            'subscription_id'=>$request->subscription_id,
            'status'=>'active',
            'end_date'=>now()->addDays($subscription->duration_in_days),
            'auto_renew'=>$request->auto_renew,
            'payment_id'=>$Payment->id
        ]);
        $user_subscription_id = $user_subscription->id ;
        event(new UserSubscriptionEvent($user_subscription_id));


        return redirect()->route('home.page')->with('success', 'Payment Successfully');
    }

    public function show($id){
        $categories = Category::all();
        $userSubscription = UserSubscription::find($id);
        $payment = Payment::find($userSubscription->payment_id);
        return view('subscription.paymentInvoice', compact('userSubscription', 'categories' , 'payment'));
    }
}
