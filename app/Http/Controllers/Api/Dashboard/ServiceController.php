<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return $this->response_success(['Services'=>ServiceResource::collection($services)]);
    }
    
    /**
     * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => "required|string|max:255",
        ]);
        $service = Service::create(['name' => $request->name]); //create service
        return $this->response_success(['Service'=> new ServiceResource($service)],'Add Service Successfully');
    }
    
    /**
     * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        if ($id == 1 || $id == 2 || $id == 3) {
            return $this->response_error('You can not update this service');
        }
        $service = Service::find($id);
        return $this->response_success(['Service'=> new ServiceResource($service)]);
    }
    
    /**
     * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required|string|max:255|unique:services,name",
        ]);
        if ($id == 1 || $id == 2 || $id == 3) {
            return $this->response_error('You can not update this service');
        }
        $service = Service::find($id);
        $service->update(['name' => $request->name]);
        return $this->response_success(['Service'=> new ServiceResource($service)] ,'Update Service Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        if ($id == 1 || $id == 2 || $id == 3) {
            return $this->response_error('You can not Delete this service');
        }
        $service = Service::find($id);
        $service->delete();
        return $this->response_success(null,'Delete Service Successfully');
    }
}
