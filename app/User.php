<?php

namespace App;

use App\Game;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $nullable = ['favorite_team'];

    public function games(){
        return $this->hasMany(Game::class, 'owner');
    }

    public function bets(){
        return $this->hasMany(Bet::class);
    }

    public function parties()
    {
        return $this->hasManyThrough(Game::class, Participant::class, 'user_id','id','id','game_id');
    }

    public function favoriteTeam()
    {
        return $this->belongsTo(Team::class,'favorite_team');
    }

    public function getFullName()
    {
        return $this->firstname.' '.strtoupper($this->lastname);
    }

    public function hasRole($role)
    {
        if($this->role == $role){
            return true;
        } else {
            return false;
        }
    }
}
