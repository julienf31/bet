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

class BetController extends BaseController
{
    public function doBet(Request $request)
    {
        $bets = $request->get('match');
        $game = $request->get('game');
        foreach ($bets as $id => $bet){
            if($bet != null){
                $b = Bet::where('user_id', Auth::user()->id)->where('game_id', $game)->where('match_id', $id)->first();
                if(!(count($b) > 0)){
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
