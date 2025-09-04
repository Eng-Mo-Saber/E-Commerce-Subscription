<?php

namespace App\Http\Controllers\Api\Web\Service;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ServiceWebController extends Controller
{
    use ApiResponseTrait ;
    public function index()
    {
        $services = Service::all();
        return $this->response_success(['Services'=>ServiceResource::collection($services)]);
    }
}
