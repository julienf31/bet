<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Game extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function users_request()
    {
        return $this->hasMany(GameRequest::class);
    }

    public function ranking()
    {
        $rank = array();
        foreach ($this->participants as $participant) {
            $part = array();
            $user = $participant->user()->first();
            $bets = $user->bets()->where('game_id', $this->id)->get();
            $part['name'] = $user->firstname;
            $part['lastname'] = $user->lastname;
            $part['pseudo'] = $user->pseudo;
            $part['id'] = $user->id;
            $part['score'] = 0;
            foreach ($bets as $bet) {
                if ($bet->result) {
                    $part['score'] += 1;
                } else {
                    //bet fail
                }
            }
            array_push($rank, $part);
        }
        return array_reverse(array_sort($rank, function ($value) {
            return $value['score'];
        }));

    }

    public function getStyledRank()
    {
        $rank = $this->ranking();

        return view('games.parts.leaderboard',compact('rank'));
    }
}
