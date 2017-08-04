<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;

class WelcomeController extends Controller
{
    public function index()
    {
    	return view('welcome');
    }
}
