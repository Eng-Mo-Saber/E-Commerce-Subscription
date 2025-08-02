<?php

namespace App\Http\Controllers\Api\Web\Service;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceWebController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json(ServiceResource::collection($services));
    }
}
