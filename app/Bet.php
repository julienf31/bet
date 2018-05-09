<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Bet extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }

    public function matches(){
        return $this->belongsTo(Match::class);
    }
}
