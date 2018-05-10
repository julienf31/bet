<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use App\Tournament;
use App\Participant;
use Analytics;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class GameController extends BaseController
{
    public function index()
    {
        $data['games'] = User::where('id',Auth::user()->id)->with(['games.tournament','games.tournament.country'])->first();

        return view('games.index', $data);
    }

    public function show($id)
    {
        $data['game'] = Game::with('participants.user')->where('id',$id)->first();
        $data['tournament'] = Tournament::find($data['game']->tournament_id);
        $data['nextmatchs'] = Tournament::find($data['game']->tournament_id)->matches()->with(['hometeam', 'visitorteam'])->where('days',$data['tournament']->currentDay)->get();
        $data['lastmatchs'] = Tournament::find($data['game']->tournament_id)->matches()->with(['hometeam', 'visitorteam'])->where('days',$data['tournament']->currentDay-1)->get();
        $data['rank'] = $data['game']->ranking();

        return view('games.show', $data);
    }

    public function create()
    {
        $data['tournaments'] = Tournament::with('country:id,code')->get();

        return view('games.create', $data);
    }

    public function edit($id)
    {
        $game = Game::with('participants.user')->where('id',$id)->first();
        $users = User::all();
        $participantsList = Participant::where('game_id',$id)->select('user_id')->get();
        $participants = array();

        foreach ($participantsList as $participant){
            $participants[] = $participant->user_id;
        }

        return view('games.edit', compact('game','users','participants'));
    }

    public function update($id,Request $request)
    {
        $game = Game::Find($id);
        $game->name = $request->get('name');
        $game->description = $request->get('description');
        if($request->get('privacy')){
            $game->privacy = 1;
        }else{
            $game->privacy = 0;
        }
        $game->save();

        $participants = $request->get('participants');

        foreach ($participants as $participant){
            if($p = Participant::where('user_id', $participant)->where('game_id',$game->id)->first()){
            }else{
                $p = new Participant();
                $p->game_id = $game->id;
                $p->user_id = $participant;
                $p->save();
            }
        }

        //remove old participants
        $participantsList = Participant::where('game_id',$game->id)->get();

        foreach ($participantsList as $oldParticipants){
            if(!in_array($oldParticipants->user_id,$participants)){
                $p = Participant::find($oldParticipants->id);
                $p->delete();
            }
        }

        return redirect()->route('games.show', $id);
    }

    public function store(Request $request){

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

        $participant = new Participant();
        $participant->user_id = $user_id;
        $participant->game_id = $game->id;
        $participant->save();

        return redirect()->route('games.show', $game->id);
    }

    public function getRanking($game_id,Request $request)
    {
        //$game = $request->get('game');
        $game = Game::find(1)->ranking();
        var_dump($game);
        die();
    }
}
