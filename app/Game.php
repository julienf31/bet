<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Game extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at','updated_at','deleted_at'];

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
            $bets = $user->bets()->where('game_id', $this->id)->where('result', true)->orWhere('result', false)->get();
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
            $part['percents'] = ($part['score']*100)/count($bets);
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
