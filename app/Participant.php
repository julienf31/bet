<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Participant extends Model
{
    public function games(){
        return $this->belongsTo(Game::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
