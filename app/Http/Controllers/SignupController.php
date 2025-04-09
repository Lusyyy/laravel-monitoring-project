<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class SignupController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            "name" => 'required|max:255',
            "contact" => 'required|max:255',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:5|max:25|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['email_verified_at'] = date("Y-m-d H:i:s");

        User::create($validatedData);
        return redirect('/')->with('success', "Registration Successfull Please Login!");
    }
}
