<?php

namespace App\Http\Controllers\Api\Web\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SubscriptionResource;
use App\Models\Service;
use Illuminate\Http\Request;

class SubscriptionWebController extends Controller
{
        public function index($id)
    {
        $service = Service::find($id);
        return response()->json(SubscriptionResource::collection($service->subscriptions));
    }
}
