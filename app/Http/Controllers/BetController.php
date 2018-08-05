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
        $game = Game::find($game_id);
        $tournament = Game::find($game_id)->tournament;
        $now = Carbon::create();
        $matches = Tournament::find($tournament->id)->matches()->where('days', '>=',$tournament->currentDay)->where('days', '<',$tournament->currentDay+$game->daysAhead)->where('date','>=', $now->addHours(+1))->get();
        $bets = Bet::where('user_id', Auth::user()->id)->whereIn('match_id', array_column($matches->toArray(),'id'))->where('game_id', $game->id)->get()->toArray();

        return view('bet.do', compact('game', 'tournament', 'matches', 'bets'));

    }

    public function doBet(Request $request)
    {
        $bets = $request->get('match');
        $game = $request->get('game');
        foreach ($bets as $id => $bet) {
            if ($bet != null) {
                $b = Bet::where('user_id', Auth::user()->id)->where('game_id', $game)->where('match_id', $id)->first();
                $bCount = Bet::where('user_id', Auth::user()->id)->where('game_id', $game)->where('match_id', $id)->get()->count();
                if (!($bCount > 0)) {
                    // create bet
                    $new_bet = new Bet();
                    $new_bet->user_id = Auth::user()->id;
                    $new_bet->game_id = $game;
                    $new_bet->match_id = $id;
                    $new_bet->bet = $bet;
                    $new_bet->save();
                } else {
                    $b->bet = $bet;
                    $b->save();
                }
            }
        }

        Toastr::success('Vos pronos ont été enregistrés', $title = 'Pronostics', $options = []);
        return Redirect::route('games.show', $game);
    }
}
