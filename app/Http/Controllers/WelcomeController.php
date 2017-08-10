<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class WelcomeController extends Controller
{
    public function index()
    {
    	return view('main.home');
    }

    public function flashs()
    {
		return view('flash');
    }

    public function login()
    {
    	return view('main.login');
    }
}
