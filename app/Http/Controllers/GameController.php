<?php

namespace App\Http\Controllers;

use Analytics;
use App\Bet;
use App\Game;
use App\GameRequest;
use App\Match;
use App\Participant;
use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
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
        $user = Auth::user();
        if(!$user->inGame($id)){
            Toastr::warning("Vous n'avez pas accés à cette partie");
            return redirect()->route('games.search');
        }
        $game = Game::with('participants.user')->where('id',$id)->first();
        $tournament = $game->tournament()->first();
        $nextmatchs = $tournament->matches()->with(['hometeam', 'visitorteam'])->where('days', '>=', $tournament->currentDay)->limit($game->daysAhead*$tournament->participants/2)->get();
        $nextmatchsID = $tournament->matches()->where('days', '>=', $tournament->currentDay)->limit($game->daysAhead*$tournament->participants/2)->select('id')->get()->toArray();
        $lastmatchs = $tournament->matches()->with(['hometeam', 'visitorteam'])->where('days',$tournament->currentDay-1)->get();
        //$rank = $game->ranking();
        $bets = $user->bets()->whereIn('match_id', $nextmatchsID)->where('game_id', $game->id)->select(['match_id','bet'])->get()->toArray();

        if($tournament->status == 3){
            $nextmatchs = null;
            $lastmatchs = $tournament->matches()->with(['hometeam', 'visitorteam'])->where('days',$tournament->currentDay)->get();
        }

        return view('games.show', compact('game','tournament', 'nextmatchs','lastmatchs','rank','bets'));
    }

    public function getRanking($game_id)
    {
        $game = Game::where('id',$game_id)->first();

        return $game->getStyledRank();
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
        $game->daysAhead = $request->get('daysAhead');
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

    public function approveList($game_id)
    {
        $game = Game::find($game_id);
        $requests = GameRequest::where('game_id', $game->id)->get();

        return view('games.requests.index', compact('game', 'requests'));
    }

    public function acceptRequest($request_id)
    {
        $request = GameRequest::find($request_id);
        $user = User::find($request->user_id);
        $game = Game::find($request->game_id);

        $participant = new Participant();
        $participant->user_id = $user->id;
        $participant->game_id = $game->id;
        $participant->save();

        $request->delete();

        return redirect(route('games.access.request.list', $game->id));
    }

    public function declineRequest($request_id)
    {
        $request = GameRequest::find($request_id);
        $game = Game::find($request->game_id);

        $request->delete();

        return redirect(route('games.access.request.list', $game->id));
    }

    public function results(Game $game)
    {
        $currentDay = $game->tournament->currentDay;
        $users = $game->participants;
        $bets = Bet::where('game_id', $game->id)->get();
        $matchs = Match::where('tournament_id', $game->tournament->id)->get();

        if($game->tournament->currentDay == 1){
            $results_available = false;
        } else {
            $results_available = true;
        }

        return view('games.results', compact('users', 'bets', 'game', 'results_available','matchs'));
    }

    public function exitGame($game_id)
    {
        $game = Game::where('id',$game_id)->first();
        $user = Auth::user();

        if(Participant::where('user_id', Auth::user()->id)->where('game_id', $game_id)->exists()){
            $participant = Participant::where('user_id', $user->id)->where('game_id', $game_id)->first();
            $participant->delete();
            Toastr::success('games.exit.confirm');
        } else {
            Toastr::error('games.exit.fail');
        }
        if($game->participants()->count() == 0){
            $game->delete();
        }

        return redirect(route('games.index'));
    }
}
