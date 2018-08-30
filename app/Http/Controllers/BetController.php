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
use Illuminate\Support\Facades\Log;
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
        $bets_o = Bet::where('user_id', Auth::user()->id)->whereIn('match_id', array_column($matches->toArray(),'id'))->where('game_id','!=', $game->id)->get()->toArray();

        if(count($bets_o) > count($bets)){
            $multiple = true;
        } else {
            $multiple = false;
        }

        return view('bet.do', compact('game', 'tournament', 'matches', 'bets','multiple'));
    }

    public function copy($game_id)
    {
        $game = Game::find($game_id);
        $now = Carbon::create();
        $tournament = Game::find($game_id)->tournament;
        $matches = Tournament::find($tournament->id)->matches()->where('days', '>=',$tournament->currentDay)->where('days', '<',$tournament->currentDay+$game->daysAhead)->where('date','>=', $now->addHours(+1))->get();
        $bets_done = Bet::where('game_id', $game_id)->where('user_id', Auth::user()->id)->whereIn('match_id', array_column($matches->toArray(),'id'))->get();
        $bets = $bets_done;
        Log::info('duplication');
        foreach ($matches as $match){
            $done = false;
            foreach ($bets as $bet){
                if($bet->match_id == $match->id){
                    $done = true;
                    Log::info("match $match->id fait");
                }
            }
            if(!$done){
                $oldBet = Bet::where('match_id', $match->id)->where('user_id', Auth::user()->id)->first();
                if(null !== $oldBet){
                    $newBet = $oldBet->replicate();
                    $newBet->game_id = $game->id;
                    $newBet->save();
                    Log::info("match $match->id dupliqué");
                }
            }
        }

        return redirect(route('bet', $game->id));
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
