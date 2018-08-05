<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $dates = ['published_at', 'created_at', 'updated_at'];

    public function changelogs()
    {
        return $this->hasMany(Changelog::class);
    }
}
