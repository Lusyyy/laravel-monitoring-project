<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function editprofile(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $rules = [
            "name" => 'required|max:255',
            "contact" => 'required|max:255',
        ];
        if($request->email != auth()->user()->email){
            $rules['email'] = 'required|email|unique:users';
        }
        $validatedData = $request->validate($rules);
        $user->update($validatedData);
        return back();
    }

    public function members()
    {
        return view('member.index', [
            "members" => User::all()
        ]);
    }

    public function makeitadmin(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $validatedData["role"] = 1;
        $user->update($validatedData);
        return back();
    }
   

    public function destroy(Request $request)
    {
        $user = User::find($request->id); 

        if ($user) {
            $user->delete();
            return back();
        }

        
    }

}