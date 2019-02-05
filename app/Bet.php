<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bet extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }

    public function match(){
        return $this->belongsTo(Match::class);
    }

    public function getStatusColor()
    {
        switch ($this->result){
            case 1:
                return 'green lighten-5';
            case 0:
                return 'red lighten-5';
        }
    }
}
