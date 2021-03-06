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
        if($this->status == NULL){
            return '<img src="'.asset('img/logos/teams/'.$this->hometeam->id.'.'.$this->hometeam->logo).'" class="img-responsive" style="display: inline-block; height: 30px; margin-right: 10px;"/> <span style="line-height: 30px"> <i class="fa fa-clock-o"></i> </span> <img src="'.asset('img/logos/teams/'.$this->visitorteam->id.'.'.$this->visitorteam->logo).'" class="img-responsive" style="display: inline-block; height: 30px;margin-left:10px;"/>';
        } else {
            return '<img src="'.asset('img/logos/teams/'.$this->hometeam->id.'.'.$this->hometeam->logo).'" class="img-responsive" style="display: inline-block; height: 30px; margin-right: 10px;"/> <span style="line-height: 30px">'.$this->home_score.' - '.$this->visitor_score.'</span> <img src="'.asset('img/logos/teams/'.$this->visitorteam->id.'.'.$this->visitorteam->logo).'" class="img-responsive" style="display: inline-block; height: 30px;margin-left:10px;"/>';
        }
    }
}
