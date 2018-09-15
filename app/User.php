<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


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

    protected $dates = ['last_login', 'created_at', 'updated_at', 'deleted_at'];

    protected $nullable = ['favorite_team'];

    public function games()
    {
        return $this->hasMany(Game::class, 'owner');
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function parties()
    {
        return $this->hasManyThrough(Game::class, Participant::class, 'user_id', 'id', 'id', 'game_id');
    }

    public function favoriteTeam()
    {
        return $this->belongsTo(Team::class, 'favorite_team');
    }

    public function games_request()
    {
        return $this->hasMany(GameRequest::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function hasRole($role)
    {
        if ($this->role == $role) {
            return true;
        } else {
            return false;
        }
    }

    public function inGame($game_id)
    {
        if ($this->parties->contains($game_id) || $this->games->contains($game_id)) {
            return true;
        } else {
            return false;
        }
    }

    public function linkToProfile(string $param)
    {
        switch ($param) {
            case 'pseudo':
                $label = $this->pseudo;
                break;
            case 'firstname':
                $label = $this->firstname;
                break;
            case 'lastname':
                $label = strtoupper($this->lastname);
                break;
            case 'fullName':
                $label = $this->getFullName();
                break;
            case 'smallName':
                $label = $this->getSmallName();
                break;
            default:
                $label = $this->pseudo;
        }

        return '<a href="' . route('profile', $this->id) . '">' . $label . '</a>';
    }

    public function getFullName()
    {
        return $this->firstname . ' ' . strtoupper($this->lastname);
    }

    public function getSmallName()
    {
        return $this->firstname . ' ' . substr(strtoupper($this->lastname), 0, 1) . '.';
    }
}
