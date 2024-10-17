<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MuaProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('homepage');
});

Route::get('/makeupbyrani', function () {
    return view('homepage');
});


Route::get('/register', [RegisterController::class, 'index']);
Route::resource('/register', RegisterController::class);


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);

Route::resource('/ourprofile', MuaProfileController::class);

Route::get('/details', function () {
    return view('layouts.detail_profile');
});
