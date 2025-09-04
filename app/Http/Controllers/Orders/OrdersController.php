<?php

namespace App\Http\Controllers\Orders;

use App\Events\AddOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public $total = 0;
    public function index()
    {

        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('order.orders', compact('orders'));
    }

    public function store(Request $request)
    {
        //validation لل address and notes
        $request->validate([
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
            'payment_method' => 'required',
        ]);
        session(['address' => $request->address, 'notes' => $request->notes]);
        if ($request->payment_method == 'cod') {
            //جاب الللى في الكارت وجاب المنتجات كلها
            $products = Product::all();
            $carts = Cart::with('product')->where('user_id', auth()->id())->get();
            foreach ($carts as $cart) {
                //حساب مجموع كل المنتجات
                $this->total += $cart->product->price * $cart->quantity;
                foreach ($products as $product) {
                    if ($product->id == $cart->product_id) {
                        //مقارنه عشان نشوف الكميه الطلوبه متوفره ام لا
                        if ($product->stock_quantity < $cart->quantity) {
                            //لو غير كافيه هيطلع ايرور
                            return redirect()->route('cart.page')->with('error', ' العدد المتبقي في المخزوم هو : ' . $product->stock_quantity . ' فقط لهذا المنتج : ' . $product->name);
                        } else {
                            //لو كافيه هينقصها من المخزن
                            $product->stock_quantity  -= $cart->quantity;
                            $product->save();
                        }
                    }
                }
            }
            //ينشي اوردر
            $Order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'address' => $request->address,
                'notes' => $request->notes,
                'total_price' => $this->total,
            ]);
            //ينشي اوردر ايتم يضيف فيه كل المنتجات اللي في الاوردر
            foreach ($carts as $cart) {
                Order_item::create([
                    'order_id' => $Order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price
                ]);
                //بعد ما يضي يحذف الكارت عشان يضيف لو هيضيف تاني
                $cart->delete();
            }

            event(new AddOrderEvent($Order->id));

            return redirect()->route('home.page')->with('success', 'تم انشاء الطلب بنجاح');
        } elseif ($request->payment_method == 'online') {

            $user = auth()->user();
            $products = Product::all();
            $carts = Cart::with('product')->where('user_id', auth()->id())->get();
            foreach ($carts as $cart) {
                //حساب مجموع كل المنتجات
                $this->total += $cart->product->price * $cart->quantity;
                foreach ($products as $product) {
                    if ($product->id == $cart->product_id) {
                        //مقارنه عشان نشوف الكميه الطلوبه متوفره ام لا
                        if ($product->stock_quantity < $cart->quantity) {
                            //لو غير كافيه هيطلع ايرور
                            return redirect()->route('cart.page')->with('error', ' العدد المتبقي في المخزوم هو : ' . $product->stock_quantity . ' فقط لهذا المنتج : ' . $product->name);
                        }
                    }
                }
            }

            $merchantId = "MID-36901-346"; // Merchant ID من كاشير
            $secret = "acaa262a-a929-439a-9582-b8e60c1bf30d"; // Secret Key من كاشير
            $orderId = 'sub-' . now()->timestamp; // رقم طلب فريد
            $amount = $this->total; // 
            $currency = "EGP";
            $mode = "test"; // أو "live" حسب الحالة

            $successRedirect = route('payment.order.handle');
            // === بناء الـ path للتوقيع ===
            $path = "/?payment={$merchantId}.{$orderId}.{$amount}.{$currency}";
            $hash = hash_hmac('sha256', $path, $secret, false);

            // === بناء رابط الدفع ===
            $paymentURL = "https://payments.kashier.io/?" .
                "merchantId={$merchantId}" .
                "&orderId={$orderId}" .
                "&amount={$amount}" .
                "&currency={$currency}" .
                "&hash={$hash}" .
                "&mode={$mode}" .
                "&merchantRedirect={$successRedirect}" .
                "&failureRedirect={$successRedirect}" .
                "&customer[name]=" . urlencode($user->name) .
                "&customer[email]=" . urlencode($user->email) .
                "&interactionSource=Ecommerce" .
                "&enable3DS=true";

            return redirect()->away($paymentURL);
        }
    }

    function handleOrderPayment()
    {
        $address = session('address');
        $notes = session('notes');
        if ($_GET['paymentStatus'] == 'SUCCESS') {
            $queryString = '';
            $secret = 'acaa262a-a929-439a-9582-b8e60c1bf30d';

            foreach ($_GET as $key => $value) {
                if ($key === 'signature' || $key === 'mode') {
                    continue;
                }
                $queryString .= '&' . $key . '=' . $value;
            }

            $queryString = ltrim($queryString, '&');
            $signature = hash_hmac('sha256', $queryString, $secret, false);

            if ($signature === $_GET['signature']) {
                // تعريف المتغيرات
                $order_id = $_GET['merchantOrderId'];
                $amount = $_GET['amount'];
                $currency = $_GET['currency'];
                $status = $_GET['paymentStatus'];
                $payment_method = $_GET['cardBrand'] ?? 'card';
                $transaction_id = $_GET['transactionId'] ?? null;
                $payment_date = now();

                // إنشاء الدفع
                $payment = Payment::create([
                    'user_id' => auth()->id(),
                    'order_id' => $order_id,
                    'amount' => $amount,
                    'currency' => $currency,
                    'status' => strtolower($status),
                    'payment_method' => $payment_method,
                    'payment_date' => $payment_date,
                    'kashier_response' => json_encode($_GET), // ده اللي جاي فعليًا من الكاشير في GET
                ]);

                //ينشي اوردر
                $Order = Order::create([
                    'user_id' => auth()->id(),
                    'status' => 'shipped',
                    'address' => $address,
                    'notes' => $notes,
                    'total_price' => $amount,
                ]);
                //ينشي اوردر ايتم يضيف فيه كل المنتجات اللي في الاوردر
                $carts = Cart::with('product')->where('user_id', auth()->id())->get();
                $products = Product::all();
                foreach ($carts as $cart) {
                    foreach ($products as $product) {
                        if ($product->id == $cart->product_id) {
                            //مقارنه عشان نشوف الكميه الطلوبه متوفره ام لا
                            if (!$product->stock_quantity < $cart->quantity) {
                                //لو كافيه هينقصها من المخزن
                                $product->stock_quantity  -= $cart->quantity;
                                $product->save();
                            }
                        }
                    }
                    Order_item::create([
                        'order_id' => $Order->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->product->price
                    ]);
                    //بعد ما يضي يحذف الكارت عشان يضيف لو هيضيف تاني
                    $cart->delete();
                }

                event(new AddOrderEvent($Order->id));

                return redirect()->route('payment-success');
            } else {
                return redirect()->route('payment-failed');
            }
        } else {

            return redirect()->route('payment-failed');
        }
    }



    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return back()->with('success', 'تم إلغاء الطلب بنجاح');
    }
}
