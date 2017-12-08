<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('home');
});

Route::get('/home', array('as' => 'home', 'uses' => 'ViewController@showHome'));

Route::get('/login', array('as' => 'login', 'uses' => 'ViewController@showLogin'));

Route::get('/register', array('as' => 'register', 'uses' => 'ViewController@showRegister'));
