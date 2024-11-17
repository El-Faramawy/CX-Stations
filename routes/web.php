<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('brand/home');
});

Route::middleware('web')->namespace('App\Http\Controllers\Brand')->group(function () {
    Route::get('share_brand/{id}', 'ShareController@ShareBrand');
    Route::get('share_ad/{id}', 'ShareController@ShareProduct');
});

require __DIR__ . '/admin.php';
require __DIR__ . '/brand.php';
