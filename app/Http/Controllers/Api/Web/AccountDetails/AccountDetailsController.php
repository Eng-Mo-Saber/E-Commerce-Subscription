<?php

namespace App\Http\Controllers\Api\Web\AccountDetails;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AccountDetailsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountDetailsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return response()->json(['user'=>new AccountDetailsResource($user)]);
    }
    
    public function editData(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'email' => 'required|email',
            'phone' => 'required|string|max:11|min:11',
            'address' => 'required|string|max:250'
        ]);
        
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        
        return response()->json(['user'=>new AccountDetailsResource($user) , 'success'=>'Details Update Successfully']);
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8|string',
            'new_password' => 'required|min:8|string',
            'confirm_new_password' => 'required|min:8|string',
        ]);
        $user = Auth::user();
        $check_old_pass = Hash::check($request->old_password, $user->password);
        if (!$check_old_pass) {
            return back()->with('error', 'Old password is wrong');
        } elseif ($request->new_password != $request->confirm_new_password) {
            return back()->with('error', 'Confirm password is wrong');
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(['success'=>'Password changed successfully']);
        }
    }
}
