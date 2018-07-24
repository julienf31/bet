<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;


class Game extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }

    public function participants(){
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
            $user = User::where('id',$participant->user_id)->first();
            $bets = User::find($participant->user_id)->bets()->where('game_id', $this->id)->get();
            $part['name'] = $user->firstname;
            $part['score'] = 0;
            foreach ($bets as $bet){
                $match = $bet->match()->first();
                if($bet->result){
                    $part['score'] += 1;
                }
                else{
                    //bet fail
                }
            }
            array_push($rank,$part);
        }
        return array_reverse(array_sort($rank, function ($value){
            return $value['score'];
        }));

    }

    public function status()
    {
        switch ($this->tournament->status) {
            case 1: return "<span class=\"label label-warning\">En attente</span>";
            case 2: return "<span class=\"label label-success\">En cours</span>";
            case 3: return "<span class=\"label label-danger\">Terminée</span>";
        }
    }
}
