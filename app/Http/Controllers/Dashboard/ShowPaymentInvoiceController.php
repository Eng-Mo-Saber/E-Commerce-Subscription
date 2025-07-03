<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class ShowPaymentInvoiceController extends Controller
{
    public function index($id)
    {
        $userSubscription = UserSubscription::find($id);
        $payment = Payment::find($userSubscription->payment_id);
        return view('dashboard.payment.paymentInvoice' , compact('userSubscription' , 'payment'));
    }
}
