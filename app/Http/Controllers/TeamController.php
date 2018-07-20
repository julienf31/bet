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
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use \Toastr;

class TeamController extends BaseController
{
    public function editTeam($team_id,Request $request){

        $team_name = $request->get('teamName');
        $team_city = $request->get('teamCity');
        $team_country = $request->get('teamCountry');

        $team = Team::find($team_id);
        $team->name = $team_name;
        $team->city = $team_city;
        $team->country_id = $team_country;

        if($request->hasFile('teamLogo')){
            $file = $request->file('teamLogo');
   
            $extension = $request->file('teamLogo')->guessExtension();
            Storage::delete('', $team->id.'.'.$extension  ,'teamLogo');
            $file = $request->file('teamLogo')->storeAs('', $team->id.'.'.$extension  ,'teamLogo');
            $team->logo = $extension;
        }

        $team->save();

        Toastr::success(Lang::get('teams.update_confirm'), $title = Lang::get('teams.update'), $options = []);

        return redirect('teams');
    }

    public function createNewteam(Request $request){

        $team_name = $request->get('teamName');
        $team_city = $request->get('teamCity');
        $team_country = $request->get('teamCountry');
        $team_type = $request->get('teamType');
        $team_logo = $request->file('teamLogo');

        if($team_type){
            $team_city = null;
            $team_type = 'national';
        }else{
            $team_type = 'local';
        }

        $team = new Team();
        $team->name = $team_name;
        $team->city = $team_city;
        $team->country_id = $team_country;
        $team->type = $team_type;
        $team->save();

        if($request->hasFile('teamLogo')){
            $file = $request->file('teamLogo');
            $extension = $request->file('teamLogo')->guessExtension();
            $file = $request->file('teamLogo')->storeAs('', $team->id.'.'.$extension  ,'teamLogo');
            $team->logo = $extension;
        }
        $team->save();

        Toastr::success(Lang::get('teams.create_confirm'), $title = Lang::get('teams.create'), $options = []);

        return redirect('teams');
    }
}
