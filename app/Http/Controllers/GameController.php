<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class GameController extends BaseController
{

    public function createNewGame(Request $request){

        $user_id = Auth::user()->id;

        $game_name = $request->get('gamename');
        $game_desc = $request->get('gamedesc');
        $game_tournament = $request->get('gametournament');
        $game_privacy = $request->get('gameprivacy');

        if($game_privacy){
            $game_privacy = 1;
        }else{
            $game_privacy = 0;
        }

        $game = new Game();
        $game->name = $game_name;
        $game->description = $game_desc;
        $game->tournament_id = $game_tournament;
        $game->privacy = $game_privacy;
        $game->owner = $user_id;
        $game->save();

        return redirect('games');
    }
}
