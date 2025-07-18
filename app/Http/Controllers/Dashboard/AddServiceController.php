<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class AddServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('dashboard.service.showServices', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.service.addService');

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
            'name'=>"required|string|max:255",
        ]);
        $service = Service::create(['name'=>$request->name]); //create service
        return redirect()->route('dashboard.addService')->with('success', 'Add Service Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == 1 || $id == 2 || $id == 3){
            return redirect()->route('dashboard.showService')->with('error', 'You can not update this service');
        }
        $service = Service::find($id);
        return view('dashboard.service.updateService', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'name'=>"required|string|max:255|unique:services,name",
        ]);

        $service = Service::find($id);
        $service->update(['name'=>$request->name]);
        return redirect()->route('dashboard.showService')->with('success', 'Update Service Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1 || $id == 2 || $id == 3){
            return redirect()->route('dashboard.showService')->with('error', 'You can not delete this service');
        }
        $service = Service::find($id);
        $service->delete();
        return redirect()->route('dashboard.showService')->with('success', 'Delete Service Successfully');  
    }
}
