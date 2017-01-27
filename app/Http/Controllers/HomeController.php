<?php

namespace CodePub\Http\Controllers;

use Illuminate\Http\Request;
use CodePub\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
    	$user = new User(); 
        return view('home'); 
    }
}
