<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Game extends Model
{
    public $coucou = "coucou";
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }

    public function participants(){
        return $this->hasMany(Participant::class);
    }

    public function ranking()
    {
        $rank = array();
        foreach ($this->participants as $participant) {
            $part = array();
            $user = User::where('id',$participant->id)->first();
            $bets = User::find($participant->id)->bets()->where('game_id', $this->id)->get();
            $part['name'] = $user->firstname;
            $part['score'] = 0;
            //echo "Paris de : ".$participant->id."<br>";
            foreach ($bets as $bet){
                $match = $bet->match()->with(['hometeam','visitorteam'])->first();
                if($match->winner == $bet->bet){
                    //bet success
                    $part['score'] += 3;
                }
                else{
                    //bet fail
                }
                //echo $bet->bet.' -> '.$match->hometeam->name.' '.$match->home_score.' - '.$match->visitor_score.' '.$match->visitorteam->name."<br>";
            }
            array_push($rank,$part);
            //echo "<br>";

        }
        return array_reverse(array_sort($rank, function ($value){
            return $value['score'];
        }));

    }
}
