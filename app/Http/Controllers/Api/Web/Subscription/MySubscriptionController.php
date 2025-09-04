<?php

namespace App\Http\Controllers\Api\Web\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\UserSubscription;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MySubscriptionController extends Controller
{
    use ApiResponseTrait ;
    public function index()
    {
        $userId = Auth::id();
        // كل الاشتراكات اللي المستخدم مشترك فيها مع الاشتراك المرتبط
        $userSubscriptions = UserSubscription::with('subscription')->where('user_id', $userId)->get();
        return $this->response_success(['UserSubscriptions'=>UserSubscriptionResource::collection($userSubscriptions)]);
    }
    public function destroy($id)
    {
        $mySub = UserSubscription::find($id);
        $mySub->status ='not_active';
        $mySub->save();
        return $this->response_success(['MySubscription'=>new UserSubscriptionResource($mySub)] , 'Your subscription has been successfully cancelled');

    }
}
