<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = "logs";

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMethod()
    {
        switch ($this->method) {
            case 'GET':
                return "<span class='badge bg-green'>$this->method</span>";
            case 'POST':
                return "<span class='badge bg-blue'>$this->method</span>";
            case 'PUT':
                return "<span class='badge bg-yellow'>$this->method</span>";
            case 'DELETE':
                return "<span class='badge bg-red'>$this->method</span>";
            case 'UPDATE':
                return "<span class='badge bg-purple'>$this->method</span>";
            default:
                return "<span class='badge'>$this->method</span>";

        }
    }
}
