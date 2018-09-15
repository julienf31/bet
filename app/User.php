<?php

namespace App;

use App\Game;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;


class User extends Authenticatable
{
    use SoftDeletes;
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

    protected $dates = ['last_login','created_at', 'updated_at', 'deleted_at'];

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

    public function games_request()
    {
        return $this->hasMany(GameRequest::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function getFullName()
    {
        return $this->firstname.' '.strtoupper($this->lastname);
    }

    public function getSmallName()
    {
        return $this->firstname.' '.substr(strtoupper($this->lastname),0,1).'.';
    }

    public function hasRole($role)
    {
        if($this->role == $role){
            return true;
        } else {
            return false;
        }
    }

    public function inGame($game_id)
    {
        if($this->parties->contains($game_id) || $this->games->contains($game_id)){
            return true;
        } else {
            return false;
        }
    }
}
