<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Changelog extends Model
{
    protected $fillable = ['title', 'description', 'version_id','type'];

    public function version()
    {
        return $this->belongsTo(Version::class);
    }
}
