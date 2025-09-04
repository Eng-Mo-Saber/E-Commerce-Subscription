<?php

namespace App\Http\Controllers\Api\Web\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SubscriptionResource;
use App\Models\Service;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SubscriptionWebController extends Controller
{
    use ApiResponseTrait ;
    public function index($id)
    {
        $service = Service::find($id);
        return $this->response_success(['Subscriptions'=>SubscriptionResource::collection($service->subscriptions)]);
    }
}
