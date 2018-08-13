<?php

namespace App\Http\Controllers;

use App\Country;
use App\Game;
use App\Match;
use App\Team;
use App\Tournament;
use App\User;
use App\Bet;
use function foo\func;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ViewController extends BaseController
{

    public function showHome(){
        $games = Auth::user()->parties()->get();
        $bets = Bet::all();

        $bets_win = Bet::where('result', true)->count();
        $bets_lost = Bet::where('result', false)->count();
        $bets_wait = Bet::whereNull('result')->count();

        $best = User::where('banned',0)->withCount(['bets' => function($query){
            $query->where('result',1);
        }])->get()->toArray();

        $bests = collect($best)->sortByDesc('bets_count');

        $best = array();
        foreach ($bests as $bests_c){
            $bets_success = Bet::where('user_id', $bests_c['id'])->where('result',1)->count();
            $user = User::where('id',$bests_c['id'])->first();
            if($user->bets->where('result',true)->count() != 0 && $user->bets->where('result',false)->count() != 0){
                $score = round(($user->bets()->where('result',true)->count()*100)/($user->bets()->where('result',true)->count() + $user->bets()->where('result',false)->count()));
            } else {
                $score = 0;
            }
            $best[] = array_merge($bests_c, ['score' => $score.' %'] );
        }

        $best = collect($best)->sortByDesc('score')->take(3);

        return view('home', compact('games','bets_win','bets_lost','bets_wait','best'));
    }

    public function showLogin(){
        if(Auth::guest())
        {
            return view('login');
        }
        else {
            return redirect(route('home'));
        }
    }


    public function showRegister(){
        return view('register');
    }

    // VUES TOURNOIS
    public function showTournaments(){
        $tournaments = Tournament::with('country:id,code,name')->get();
        $countries = Tournament::select('country_id')->distinct('country_id')->get()->count();
        $teams = Team::all()->count();
        return view('tournaments.list', compact('tournaments','countries','teams'));
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
        $matches = Tournament::find($data['tournament']->id)->matches()->where('days', $data['tournament']->currentDay)->select('id')->get()->toArray();
        $data['bets'] = Bet::where('user_id', Auth::user()->id)->whereIn('match_id', $matches)->where('game_id', $data['game']->id)->get()->toArray();
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
