<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Team extends Model
{
    public function tournaments(){
        return $this->belongsToMany(Tournament::class, 'tournaments_teams');
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function matches(){
        return $this->hasMany(Match::class);
    }

    public function img($size = null){
        return '<img class="img-responsive" src="'.asset('img/logos/teams/'.$this->id.'.'.$this->logo).'" width="18px" style="display:inline">';
    }
}
