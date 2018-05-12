<?php

namespace bsm\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
