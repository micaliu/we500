<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function indexAction()
    {
    	return "Welcome to Laravel Class!";
    	// return view('welcome');
    }
}
