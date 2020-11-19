<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Home view
    public function index()
    {
        return view('home.index');
    }
}
