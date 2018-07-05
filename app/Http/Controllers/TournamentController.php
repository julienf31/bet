<?php

namespace App\Http\Controllers;

use App\Game;
use App\Team;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use \Toastr;
use \Lang;

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
        $teams = Team::all();
        $tournament_teams = array();
        foreach ($tournament->teams as $team){
            $tournament_teams[] = $team->id;
        }
        return view('tournaments.teams.list', compact('tournament', 'teams','tournament_teams'));
    }

    public function  matchesManagement($id)
    {
        $tournament = Tournament::find($id);
        $days = array();
        for ($i = 1; $i <= $tournament->days; $i++){
            $matchCount = $tournament->matches()->where('days', $i)->count();
            $temp = ['number' => $i, 'matches' => $matchCount];
            $days[] = $temp;
        }
        return view('tournaments.matches.management', compact('tournament','days'));
    }

    public function matches($id)
    {
        $tournament = Tournament::find($id);
        return view('tournaments.matches.list', compact('tournament'));
    }

    public function removeTeam($tournament_id,$team_id)
    {
        $tournament = Tournament::find($tournament_id);
        $tournament->teams()->detach($team_id);

        Toastr::success(Lang::get('tournaments.remove_team_confirm'), $title = Lang::get('tournaments.remove_team'), $options = []);

        return redirect(url()->previous());
    }

    public function addTeam($tournament_id,Request $request)
    {
        $tournament = Tournament::find($tournament_id);
        $team_id = $request->get('team');
        $tournament->teams()->attach($team_id);

        Toastr::success(Lang::get('tournaments.add_team_confirm'), $title = Lang::get('tournaments.add_team'), $options = []);

        return redirect(url()->previous());
    }
}
