<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameRequest extends Model
{
    protected $table = "games_request";

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
