<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Actions // Method // Funtions 
    public function index()
    {
        // return response (view, json, redirect)

        return view('index');
    }


    public function table()
    {
        $x = 5;

        $items = [
            '1',
            '2',
            '3'
        ];
        // $items = [];

        $supported_mail = config('souqpro.supported_mail','no mail');
        return view('table', compact('items','x','supported_mail'));
        // return view('table')->with('word','Hello');
        // return view('table',[
        //     'items' => $items,
        //     'z' => $x
        // ]);
    }
}
