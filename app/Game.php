<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Game extends Model
{
    public function user(){
        return $this->belongsTo('User');
    }

    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }
}
