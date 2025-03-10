<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
