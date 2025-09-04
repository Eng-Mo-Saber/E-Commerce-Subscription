<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentPageController extends Controller
{
    public function ShowPageSuccess()
    {
        return view('payment.success');
    }
    public function ShowPageFailed()
    {
        return view('payment.failed');
    }
}
