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
            $user = User::where('id', $participant->user_id)->first();
            $bets = User::find($participant->user_id)->bets()->where('game_id', $this->id)->get();
            $part['name'] = $user->firstname;
            $part['lastname'] = $user->lastname;
            $part['pseudo'] = $user->pseudo;
            $part['id'] = $user->id;
            $part['score'] = 0;
            foreach ($bets as $bet) {
                $match = $bet->match()->first();
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

        $rank = array();
        foreach ($this->participants as $participant) {
            $part = array();
            $user = User::where('id', $participant->user_id)->first();
            $bets = User::find($participant->user_id)->bets()->where('game_id', $this->id)->get();
            $part['name'] = $user->firstname;
            $part['lastname'] = $user->lastname;
            $part['pseudo'] = $user->pseudo;
            $part['id'] = $user->id;
            $part['score'] = 0;
            foreach ($bets as $bet) {
                $match = $bet->match()->first();
                if ($bet->result) {
                    $part['score'] += 1;
                } else {
                    //bet fail
                }
            }
            array_push($rank, $part);
        }
        $rank = array_reverse(array_sort($rank, function ($value) {
            return $value['score'];
        }));

        $return = '<table class="table tab-pane"><tr><th style="width: 20px;"></th><th>Pseudo</th><th>Score</th></tr>';
        foreach ($rank as $i => $r) {
            switch ($i){
                case 0:
                    $star = '<i class="fa fa-star text-yellow"></i>';
                    break;
                case 1:
                    $star = '<i class="fa fa-star text-gray"></i>';
                    break;
                case 2:
                    $star = '<i class="fa fa-star text-brown"></i>';
                    break;
                default:
                    $star = '';
            }
            $return = $return.'<tr><td>'.$star.'</td>';
            $return = $return.'<td><a href="'.route('profile', $r['id']).'" data-toggle="tooltip" title="'.$r['pseudo'].'">'.$r['name'].' '.strtoupper(substr($r['lastname'],0,1)).'</a></td><td>'.$r['score'].'</td></tr>';
        }
        $return = $return.'</table>';

        return $return;
    }
}
