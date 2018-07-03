<?php

namespace App\Http\Controllers;

use App\Game;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TournamentController extends BaseController
{
    public function editTournament($tournament_id,Request $request){

        $tournament_name = $request->get('tournamentName');
        $tournament_desc = $request->get('tournamentDesc');
        $tournament_country = $request->get('tournamentCountry');

        $tournament = Tournament::find($tournament_id);
        $tournament->name = $tournament_name;
        $tournament->description = $tournament_desc;
        $tournament->country_id = $tournament_country;
        $tournament->save();

        return redirect('tournaments');
    }

    public function createNewTournament(Request $request){

        $tournament_name = $request->get('tournamentName');
        $tournament_desc = $request->get('tournamentDesc');
        $tournament_country = $request->get('tournamentCountry');
        $tournament_type = $request->get('tournamentType');
        $tournament_year = $request->get('tournamentYear');

        $tournament = new Tournament();
        $tournament->name = $tournament_name;
        $tournament->description = $tournament_desc;
        $tournament->country_id = $tournament_country;
        $tournament->type = $tournament_type;
        $tournament->year = $tournament_year;
        $tournament->save();

        return redirect('tournaments');
    }

    public function teams($id)
    {
        $tournament = Tournament::find($id);
        return view('tournaments.teams.list', compact('tournament'));
    }

    public function matches($id)
    {
        $tournament = Tournament::find($id);
        return view('tournaments.matches.list', compact('tournament'));
    }
}
