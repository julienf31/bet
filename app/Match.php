<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Match extends Model
{
    protected $dates = ['date'];

    public function hometeam(){
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function visitorteam(){
        return $this->belongsTo(Team::class, 'visitor_team_id');
    }

    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }

    public function getIcons()
    {
        return '<img src="'.asset('img/logos/teams/'.$this->hometeam->id.'.'.$this->hometeam->logo).'" class="img-responsive" style="display: inline-block; height: 30px;"/><img src="'.asset('img/logos/teams/'.$this->visitorteam->id.'.'.$this->visitorteam->logo).'" class="img-responsive" style="display: inline-block; height: 30px;"/>';
    }
}
