<?php

namespace App\Http\Controllers;

use App\Country;
use App\Game;
use App\Match;
use App\Team;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ViewController extends BaseController
{

    public function showHome(){
        return view('home');
    }

    public function showLogin(){
        return view('login');
    }

    public function logout(){
        Auth::logout();
        return redirect('home');
    }

    public function showRegister(){
        return view('register');
    }

    // VUES TOURNOIS
    public function showTournaments(){
        $data['tournaments'] = Tournament::with('country:id,code,name')->get();
        $data['countries'] = Tournament::select('country_id')->distinct('country_id')->get()->count();
        $data['teams'] = Team::all()->count();
        return view('tournaments.list', $data);
    }

    public function showTournamentsDetails($tournament_id){
        //récupération des informations du tournois
        $data['tournament'] = Tournament::find($tournament_id);
        //récupération des équipes du tournois
        $data['teams'] = Tournament::find($tournament_id)->teams()->orderBy('name')->get();
        //récupération de la journée
        $data['lastmatchs'] = Tournament::find($tournament_id)->matches()->with(['hometeam','visitorteam'])->where('days',1)->get();
        return view('tournaments.details', $data);
    }

    public function showNewTournament(){
        //$data['games'] = User::find(Auth::user()->id)->games;
        $data['tournaments'] = Tournament::with('country:id,code')->get();
        $data['countries'] = Country::all();

        return view('tournaments.new', $data);
    }

    public function showTournamentsEdit($tournament_id){
        //récupération des informations du tournois
        $data['tournament'] = Tournament::find($tournament_id);
        //récupération des équipes du tournois
        $data['teams'] = Tournament::find($tournament_id)->teams()->orderBy('name')->get();
        //récupération des pays
        $data['countries'] = Country::all();
        return view('tournaments.edit', $data);
    }

    // VUES PARTIES
    public function showGames(){
        $data['games'] = User::find(Auth::user()->id)->with(['games.tournament','games.tournament.country'])->first();
        return view('games.list', $data);
    }

    public function showNewGames(){
        $data['tournaments'] = Tournament::with('country:id,code')->get();
        return view('games.new', $data);
    }

    public function showGameDetails($id){
        $data['game'] = Game::with('participants.user')->where('id',$id)->first();
        $data['tournament'] = Tournament::find($data['game']->tournament_id);
        $data['nextmatchs'] = Tournament::find($data['game']->tournament_id)->matches()->with(['hometeam', 'visitorteam'])->where('days',$data['tournament']->currentDay)->get();
        $data['lastmatchs'] = Tournament::find($data['game']->tournament_id)->matches()->with(['hometeam', 'visitorteam'])->where('days',$data['tournament']->currentDay-1)->get();

        return view('games.details', $data);
    }

    public function showGameEdit($id){
        $data['game'] = Game::with('participants.user')->where('id',$id)->first();

        return view('games.edit', $data);
    }

    // VUES TEAMS
    public function showTeams(){
        $data['teams'] = Team::with('country')->orderBy('name')->get();
        return view('teams.list', $data);
    }

    public function showTeamsEdit($team_id){
        //récupération des informations du tournois
        $data['team'] = Team::find($team_id);
        //récupération des pays
        $data['countries'] = Country::all();
        return view('teams.edit', $data);
    }

    public function showNewTeam(){
        $data['countries'] = Country::all();

        return view('teams.new', $data);
    }

    public function showBet($game_id){
        $data['game'] = Game::find($game_id);
        $data['tournament'] = Game::find($game_id)->tournament;
        $data['matches'] = Tournament::find($data['tournament']->id)->matches()->where('days', $data['tournament']->currentDay)->get();
        return view('bet.do', $data);
    }

    public function test(){
        echo '$match = Match::find(1)->hometeam;<br>';
        $match = Match::find(1)->hometeam;
        echo $match->name;
        echo '<br>$match = Match::find(1)->visitorteam;<br>';
        $match = Match::find(1)->visitorteam;
        echo $match->name;
        echo '<br>$match = Tournament::find(1)->matches;<br>';
        $match = Tournament::find(1)->matches;
        echo $match;
        echo '<br>$match = Tournament::find(1)->matches;<br>';
        $match = Tournament::find(1)->matches()->with(['hometeam', 'visitorteam'])->where('days', 1)->get();
        echo $match;

        die();
    }
}
