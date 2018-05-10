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
Route::get('/tournaments/new', array('as' => 'tournaments.new', 'uses' => 'ViewController@showNewTournament'));
Route::post('/tournaments/new', array('as' => 'tournaments.new', 'uses' => 'TournamentController@createNewTournament'));


// routes ok
Route::get('/games', array('as' => 'games.index', 'uses' => 'GameController@index'));
Route::get('/games/new', array('as' => 'games.create', 'uses' => 'GameController@create'));
Route::post('/games/new', array('as' => 'games.create', 'uses' => 'GameController@store'));
Route::get('/games/details/{id}', array('as' => 'games.show', 'uses' => 'GameController@show'));
Route::get('/games/edit/{id}', array('as' => 'games.edit', 'uses' => 'GameController@edit'));
Route::post('/games/edit/{id}', array('as' => 'games.update', 'uses' => 'GameController@update'));

Route::get('/teams', array('as' => 'teams.list', 'uses' => 'ViewController@showTeams'));
Route::get('/teams/edit/{id}', array('as' => 'teams.edit', 'uses' => 'ViewController@showTeamsEdit'));
Route::post('/teams/edit/{id}', array('as' => 'teams.edit', 'uses' => 'TeamController@editTeam'));
Route::get('/teams/details/{id}', array('as' => 'teams.details', 'uses' => 'ViewController@showTeamDetails'));
Route::get('/teams/new', array('as' => 'teams.new', 'uses' => 'ViewController@showNewTeam'));
Route::post('/teams/new', array('as' => 'teams.new', 'uses' => 'TeamController@createNewTeam'));

Route::get('/scoring/{game}', array('as' => 'games.score', 'uses' => 'GameController@getRanking'));




Route::get('/test', array('as' => 'test', 'uses' => 'ViewController@test'));

Route::get('/bet/{game_id}', array('as' => 'bet', 'uses' => 'BetController@show'));
Route::post('/bet/{game_id}', array('as' => 'bet.save', 'uses' => 'BetController@doBet'));
