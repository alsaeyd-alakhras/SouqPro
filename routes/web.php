<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/dashboard/home',[HomeController::class,'index']);
Route::get('/dashboard/table',[HomeController::class,'table']);
