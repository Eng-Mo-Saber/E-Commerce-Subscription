<?php

namespace App\Http\Controllers\Api\Web\product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\Web\ProductsHomeResource;
use App\Models\Product;
use App\Models\UserSubscription;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleProductController extends Controller
{
    use ApiResponseTrait ;
    public function index($id)
    {
        $product = Product::find($id);
        $userId = Auth::id();

        // كل الاشتراكات اللي المستخدم مشترك فيها مع الاشتراك المرتبط
        $userSubscriptions = UserSubscription::with('subscription')->where('user_id', $userId)->get();
        $typeSubAudio = null;
        $typeSubReading = null;
        $typeSubDownload = null;
        // بيعرف هو مشترك في انهي خدمة
        foreach ($userSubscriptions as  $userSubscription) {
            if ($userSubscription['subscription']['type'] == 'audio') {
                $typeSubAudio = $userSubscription['subscription']['type'];
            }
            if ($userSubscription['subscription']['type'] == 'reading') {
                $typeSubReading = $userSubscription['subscription']['type'];
            }
            if ($userSubscription['subscription']['type'] == 'download') {
                $typeSubDownload = $userSubscription['subscription']['type'];
            }
        }
        return $this->response_success([
            'product' => new ProductsHomeResource($product),
            'typeSubDownload' => $typeSubDownload,
            'typeSubAudio' => $typeSubAudio,
            'typeSubReading' => $typeSubReading
        ], 200);

    }
}
