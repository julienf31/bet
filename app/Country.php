<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Country extends Model
{
    public function tournaments(){
        return $this->hasMany(Tournament::class);
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }
}
