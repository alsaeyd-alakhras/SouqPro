<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Actions // Method // Funtions 
    public function index()
    {
        // return response (view, json, redirect)

        return view('dashboard');
    }
}
