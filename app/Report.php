<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        switch ($this->type){
            case 0:
                return 'Autre';
            case 1:
                return 'Bug';
            case 2:
                return 'Feature';
        }
    }

    public function color()
    {
        switch ($this->type){
            case 0:
                return '';
            case 1:
                if($this->priority){
                    return 'bg-danger';
                }
                return 'bg-warning';
            case 2:
                return 'bg-info';
        }
    }
}
