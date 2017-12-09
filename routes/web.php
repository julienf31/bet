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
Route::post('/login', array('as' => 'login', 'uses' => 'LoginController@login'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'ViewController@logout'));

Route::get('/register', array('as' => 'register', 'uses' => 'ViewController@showRegister'));

Route::get('/profile', array('as' => 'profile', 'uses' => 'ViewController@showHome'));

Route::get('/tournaments', array('as' => 'tournaments.list', 'uses' => 'ViewController@showTournaments'));

Route::get('/tournaments/details/{id}', array('as' => 'tournaments.details', 'uses' => 'ViewController@showTournamentsDetails'));

Route::get('/tournaments/edit/{id}', array('as' => 'tournaments.edit', 'uses' => 'ViewController@showTournamentsEdit'));
Route::post('/tournaments/edit/{id}', array('as' => 'tournaments.edit', 'uses' => 'TournamentController@editTournament'));

Route::get('/tournaments/new', array('as' => 'tournaments.new', 'uses' => 'ViewController@showNewTournaments'));
Route::post('/tournaments/new', array('as' => 'tournaments.new', 'uses' => 'TournamentController@createNewTournament'));

Route::get('/games', array('as' => 'games.list', 'uses' => 'ViewController@showGames'));

Route::get('/games/new', array('as' => 'games.new', 'uses' => 'ViewController@showNewGames'));
Route::post('/games/new', array('as' => 'games.new', 'uses' => 'GameController@createNewGame'));

Route::get('/test', array('as' => 'test', 'uses' => 'ViewController@test'));
