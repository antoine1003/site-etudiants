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
    	flash('Bonsoir')->success();
    	return view('welcome');
    }

    public function flashs()
    {
		return view('flash');
    }
}
