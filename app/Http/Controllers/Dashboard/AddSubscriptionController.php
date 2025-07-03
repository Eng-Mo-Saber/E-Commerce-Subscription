<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AddSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('dashboard.subscription.showSubscription', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('dashboard.subscription.addSubscription' , compact('services'));
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
            'name'=>"required|string|max:100",
            'description'=>"required|string|max:255",
            'type'=>"required|string|max:100",
            'price'=>"required|integer",
            'duration_in_days'=>"required|integer",
        ]);


        Subscription::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'type'=>$request->type,
            'price'=>$request->price,
            'duration_in_days'=>$request->duration_in_days,
            'service_id'=>Service::where('name', $request->type)->value('id'),
        ]);

        return redirect()->route('dashboard.showSubscription')->with('success' , 'Add Subscription Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id == 5 || $id == 6 || $id == 7 || $id == 8 || $id == 9){
            return redirect()->route('dashboard.showSubscription')->with('error' , 'Can\'t Update This Subscription');
        }
        $subscription = Subscription::find($id);
        $services = Service::all();
        return view('dashboard.subscription.updateSubscription' , compact('subscription' , 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
            'name'=>"sometimes|string|max:100",
            'description'=>"sometimes|string|max:255",
            'type'=>"sometimes|string|max:100",
            'price'=>"sometimes|integer",
            'duration_in_days'=>"sometimes|integer",
        ]);

        $subscription = Subscription::find($id);
        $subscription->name = $request->input('name', $subscription->name);
        $subscription->description = $request->input('description', $subscription->description);
        $subscription->type = $request->input('type', $subscription->type);
        $subscription->price = $request->input('price', $subscription->price);
        $subscription->duration_in_days = $request->input('duration_in_days', $subscription->duration_in_days);
        $subscription->service_id = Service::where('name', $request->type)->value('id');
        $subscription->save();

        return redirect()->route('dashboard.showSubscription')->with('success' , 'Update Subscription Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id == 5 || $id == 6 || $id == 7 || $id == 8 || $id == 9){
            return redirect()->route('dashboard.showSubscription')->with('error' , 'Can\'t Delete This Subscription');
        }
        $subscription = Subscription::find($id);
        $subscription->delete();
        return redirect()->route('dashboard.showSubscription')->with('success' , 'Delete Subscription Successfully');
    }
}
