<?php

namespace App\Http\Controllers;

use App\Country;
use App\Game;
use App\Match;
use App\Team;
use App\Tournament;
use App\User;
use App\Bet;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Kamaln7\Toastr\Facades\Toastr;

class BetController extends BaseController
{
    public function show($game_id)
    {
        $data['game'] = Game::find($game_id);
        $data['tournament'] = Game::find($game_id)->tournament;
        $data['matches'] = Tournament::find($data['tournament']->id)->matches()->where('days', $data['tournament']->currentDay)->get();
        $matches = Tournament::find($data['tournament']->id)->matches()->where('days', $data['tournament']->currentDay)->select('id')->get()->toArray();
        $data['bets'] = Bet::where('user_id', Auth::user()->id)->whereIn('match_id', $matches)->where('game_id', $data['game']->id)->get()->toArray();

        $firstMatch = Tournament::find($data['tournament']->id)->matches()->where('days', $data['tournament']->currentDay)->select('date')->orderBy('date')->first();
        $firstMatch = Carbon::parse($firstMatch->date);
        $now = Carbon::create();

        //check if first match is in less than one hour
        if($firstMatch->lt($now->addHours(+1))){
            Toastr::error('Les paris pour cette journée ne sont plus disponible !', $title = 'Erreur', $options = []);
            return redirect()->route('games.show', $game_id);
        }else{
            return view('bet.do', $data);
        }
    }

    public function doBet(Request $request)
    {
        $bets = $request->get('match');
        $game = $request->get('game');
        foreach ($bets as $id => $bet){
            if($bet != null){
                $b = Bet::where('user_id', Auth::user()->id)->where('game_id', $game)->where('match_id', $id)->first();
                $bCount = Bet::where('user_id', Auth::user()->id)->where('game_id', $game)->where('match_id', $id)->get()->count();
                if(!($bCount > 0)){
                    // create bet
                    $new_bet = new Bet();
                    $new_bet->user_id = Auth::user()->id;
                    $new_bet->game_id = $game;
                    $new_bet->match_id = $id;
                    $new_bet->bet = $bet;
                    $new_bet->save();
                }else{
                    $b->bet = $bet;
                    $b->save();
                }
            }
        }

        return Redirect::route('bet',$game);
    }
}
