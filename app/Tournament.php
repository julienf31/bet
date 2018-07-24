<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Tournament extends Model
{
    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function games(){
        return $this->hasMany(Game::class);
    }

    public function teams(){
        return $this->belongsToMany(Team::class, 'tournaments_teams');
    }

    public function matches(){
        return $this->hasMany(Match::class);
    }

    public function status()
    {
        switch ($this->status) {
            case 1: return "<span class=\"label label-warning\">En attente</span>";
            case 2: return "<span class=\"label label-success\">En cours</span>";
            case 3: return "<span class=\"label label-danger\">Terminée</span>";
        }
    }
}
