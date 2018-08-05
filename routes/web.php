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

use Illuminate\Support\Facades\App;

App::setLocale('fr');
Route::get('/', function () {
    return Redirect::route('home');
});


Route::get('/login', array('as' => 'login', 'uses' => 'ViewController@showLogin'));
Route::post('/login', array('as' => 'login', 'uses' => 'LoginController@login'));

Route::get('/register', array('as' => 'register', 'uses' => 'ViewController@showRegister'));
Route::post('/register', array('as' => 'register', 'uses' => 'LoginController@register'));

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', array('as' => 'home', 'uses' => 'ViewController@showHome'));

    Route::get('/logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));

    Route::get('/profiles', array('as' => 'profile.index', 'uses' => 'ProfileController@index'));
    Route::get('/profile/{id?}', array('as' => 'profile', 'uses' => 'ProfileController@show'))->where('id', '[0-9]+');
    Route::get('/profile/edit/{id?}', array('as' => 'profile.edit', 'uses' => 'ProfileController@edit'))->where('id', '[0-9]+');
    Route::post('/profile/edit/{id?}', array('as' => 'profile.update', 'uses' => 'ProfileController@update'))->where('id', '[0-9]+');

    Route::get('/tournaments', array('as' => 'tournaments.list', 'uses' => 'ViewController@showTournaments'));
    Route::get('/tournaments/details/{id}', array('as' => 'tournaments.details', 'uses' => 'ViewController@showTournamentsDetails'));
    Route::get('/tournaments/edit/{id}', array('as' => 'tournaments.edit', 'uses' => 'ViewController@showTournamentsEdit'));
    Route::post('/tournaments/edit/{id}', array('as' => 'tournaments.edit', 'uses' => 'TournamentController@editTournament'));
    Route::get('/tournaments/new', array('as' => 'tournaments.new', 'uses' => 'ViewController@showNewTournament'));
    Route::post('/tournaments/new', array('as' => 'tournaments.new', 'uses' => 'TournamentController@createNewTournament'));
    Route::get('/tournaments/{id}/teams', array('as' => 'tournaments.teams', 'uses' => 'TournamentController@teams'));
    Route::get('/tournaments/{id}/matches', array('as' => 'tournaments.matches', 'uses' => 'TournamentController@matchesManagement'));
    Route::get('/tournaments/{id}/matches/day/{day}', array('as' => 'tournaments.day.matches', 'uses' => 'TournamentController@matchesByDay'));
    Route::post('/tournaments/{id}/matches/day/{day}', array('as' => 'tournaments.day.matches', 'uses' => 'TournamentController@updateMatchesByDay'));
    Route::get('/tournaments/{id}/matches/day/{day}/show', array('as' => 'tournaments.day.matches.show', 'uses' => 'TournamentController@showMatchesByDay'));
    Route::get('/tournaments/{id}/matches/{match_id}/done', array('as' => 'tournaments.matches.complete', 'uses' => 'TournamentController@completeMatch'));
    Route::post('/tournaments/{id}/matches/{match_id}/done', array('as' => 'tournaments.matches.complete', 'uses' => 'TournamentController@completeMatchStore'));
    Route::get('/tournaments/{id}/matches/{match_id}/done/cancel', array('as' => 'tournaments.matches.cancelComplete', 'uses' => 'TournamentController@cancelCompleteMatch'));

    Route::get('/games', array('as' => 'games.index', 'uses' => 'GameController@index'));
    Route::get('/games/search', array('as' => 'games.search', 'uses' => 'GameController@search'));
    Route::get('/games/new', array('as' => 'games.create', 'uses' => 'GameController@create'));
    Route::post('/games/new', array('as' => 'games.create', 'uses' => 'GameController@store'));
    Route::get('/games/details/{id}', array('as' => 'games.show', 'uses' => 'GameController@show'));
    Route::get('/games/edit/{id}', array('as' => 'games.edit', 'uses' => 'GameController@edit'));
    Route::post('/games/edit/{id}', array('as' => 'games.update', 'uses' => 'GameController@update'));
    Route::get('/games/access/{id}', array('as' => 'games.access.request', 'uses' => 'GameController@accessRequest'));
    Route::get('/games/approve/{id}', array('as' => 'games.access.request.list', 'uses' => 'GameController@approveList'));
    Route::get('/games/request/{id}/accept', array('as' => 'games.access.request.accept', 'uses' => 'GameController@acceptRequest'));
    Route::get('/games/request/{id}/deny', array('as' => 'games.access.request.deny', 'uses' => 'GameController@declineRequest'));
    Route::get('/games/{game}/results', array('as' => 'games.results', 'uses' => 'GameController@results'));

    Route::get('/teams', array('as' => 'teams.list', 'uses' => 'ViewController@showTeams'));
    Route::get('/teams/edit/{id}', array('as' => 'teams.edit', 'uses' => 'ViewController@showTeamsEdit'));
    Route::post('/teams/edit/{id}', array('as' => 'teams.edit', 'uses' => 'TeamController@editTeam'));
    Route::get('/teams/details/{id}', array('as' => 'teams.details', 'uses' => 'ViewController@showTeamDetails'));
    Route::get('/teams/new', array('as' => 'teams.new', 'uses' => 'ViewController@showNewTeam'));
    Route::post('/teams/new', array('as' => 'teams.new', 'uses' => 'TeamController@createNewTeam'));

    Route::post('/tournament/{tournament_id}/teams/add', array('as' => 'teams.tournament.add', 'uses' => 'TournamentController@addTeam'));
    Route::get('/tournament/{tournament_id}/teams/{team_id}/remove', array('as' => 'teams.tournament.remove', 'uses' => 'TournamentController@removeTeam'));

    Route::get('/scoring/{game}', array('as' => 'games.score', 'uses' => 'GameController@getRanking'));

    Route::get('/bet/{game_id}', array('as' => 'bet', 'uses' => 'BetController@show'));
    Route::post('/bet/{game_id}', array('as' => 'bet.save', 'uses' => 'BetController@doBet'));

    Route::get('/report', array('as' => 'report', 'uses' => 'ReportController@create'));
    Route::post('/report', array('as' => 'report', 'uses' => 'ReportController@post'));
    Route::get('/reports', array('as' => 'report.index', 'uses' => 'ReportController@index'));
    Route::get('/report/{id}/seen', array('as' => 'report.seen', 'uses' => 'ReportController@seen'));
    Route::get('/report/{id}', array('as' => 'report.show', 'uses' => 'ReportController@show'));
});


Route::get('/test', array('as' => 'test', 'uses' => 'ViewController@test'));