<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// get | post | put | patch | delete


Route::group([
    'middleware' => 'auth',
    'prefix' => 'dashboard',
    'as' => 'dashboard.'
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/table', [HomeController::class, 'table'])->name('table');

    // categories
    // Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware()->group(function(){

// });

// Route::group([
//     'middleware' => 'auth',
// ], function () {
//     Route::get('/dashboard/home', [HomeController::class, 'index']);
//     Route::get('/dashboard/table', [HomeController::class, 'table']);
// });

require __DIR__ . '/auth.php';
