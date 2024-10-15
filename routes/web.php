<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/makeupbyrani', function () {
    return view('homepage');
});


Route::get('/register', function () {
    return view('layouts.register');
});

Route::get('/login', function () {
    return view('layouts.login');
});

