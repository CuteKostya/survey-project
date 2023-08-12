<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        return view('login.index');
    }

    public function store(Request $request)
    {
        // authenticate user


        // if (true) {
        // return redirect()->back()->withInput();
        // }

        return redirect()->route('home');
    }
}
