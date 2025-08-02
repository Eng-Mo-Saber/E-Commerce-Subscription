<?php

namespace App\Http\Controllers\Api\Web\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MySubscriptionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        // كل الاشتراكات اللي المستخدم مشترك فيها مع الاشتراك المرتبط
        $userSubscriptions = UserSubscription::with('subscription')->where('user_id', $userId)->get();
        return response()->json(UserSubscriptionResource::collection($userSubscriptions));
    }
    public function destroy($id)
    {
        $mySub = UserSubscription::find($id);
        $mySub->status ='not_active';
        $mySub->save();
        return response()->json(['mySubscription'=>new UserSubscriptionResource($mySub), 'massage'=>'Your subscription has been successfully cancelled']);

    }
}
