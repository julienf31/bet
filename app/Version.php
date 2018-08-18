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

    public function getType()
    {
        switch ($this->type) {
            case 'dev':
                return '<span class="badge bg-aqua">Développement</span>';
            case 'fix':
                return '<span class="badge bg-yellow-active">Correctif</span>';

        }
    }
}
