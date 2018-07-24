<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use App\GameRequest;
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
use Toastr;

class GameController extends BaseController
{
    public function index()
    {
        $games = User::find(Auth::user()->id)->parties;

        return view('games.index', compact('games'));
    }

    public function search()
    {
        $games = Game::where('privacy',0)->get();

        return view('games.search', compact('games'));
    }

    public function show($id)
    {
        if(!Auth::user()->inGame($id)){
            Toastr::warning("Vous n'avez pas accés à cette partie");
            return redirect()->route('games.search');
        }
        $game = Game::with('participants.user')->where('id',$id)->first();
        $tournament = Tournament::find($game->tournament_id);
        $nextmatchs = Tournament::find($game->tournament_id)->matches()->with(['hometeam', 'visitorteam'])->where('days',$tournament->currentDay)->get();
        $nextmatchsID = Tournament::find($game->tournament_id)->matches()->where('days',$tournament->currentDay)->select('id')->get()->toArray();
        $lastmatchs = Tournament::find($game->tournament_id)->matches()->with(['hometeam', 'visitorteam'])->where('days',$tournament->currentDay-1)->get();
        $rank = $game->ranking();
        $bets = Auth::user()->bets()->whereIn('match_id', $nextmatchsID)->select(['match_id','bet'])->get()->toArray();

        return view('games.show', compact('game','tournament', 'nextmatchs','lastmatchs','rank','bets'));
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

    public function accessRequest($game_id)
    {
        $game = Game::find($game_id);
        $user = Auth::user();

        if(GameRequest::where('user_id', $user->id)->where('game_id', $game->id)->exists()){
            Toastr::warning('games.request.already');
            return redirect()->route('games.search');
        } else {
            $game_request = new GameRequest();
            $game_request->game_id = $game->id;
            $game_request->user_id = $user->id;
            $game_request->message = 'coucou';

            $game_request->save();

            Toastr::success('games.request.confirm');
            return redirect()->route('games.search');
        }
    }
}
