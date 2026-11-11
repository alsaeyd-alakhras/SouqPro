<?php

use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'site.',
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
