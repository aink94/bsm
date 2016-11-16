<?php

namespace bsm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MainController extends Controller
{
    public function index()
    {
    	return view('home');

    }
    
}
