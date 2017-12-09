<?php

namespace App\Http\Controllers;

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

    public function showTournaments(){
        $data['tournaments'] = Tournament::with('country:id,code,name')->get();

        return view('tournaments.list', $data);
    }

    public function showTournamentsDetails($tournament_id){
        $data['tournament'] = Tournament::find($tournament_id);
        $data['teams'] = Tournament::find($tournament_id)->teams()->orderBy('name')->get();
        $data['lastmatchs'] = Match::find($tournament_id)->with(['hometeam','visitorteam'])->where('tournament_id',$tournament_id)->where('days',1)->get();
        return view('tournaments.details', $data);
    }

    public function showGames(){
        $data['games'] = User::find(Auth::user()->id)->with(['games.tournament','games.tournament.country'])->first();
        return view('games.list', $data);
    }

    public function showNewGames(){
        //$data['games'] = User::find(Auth::user()->id)->games;
        $data['tournaments'] = Tournament::with('country:id,code')->get();
        return view('games.new', $data);
    }
}
