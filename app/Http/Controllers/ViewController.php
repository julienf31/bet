<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ViewController extends BaseController
{
    public function showHome(){
        return view('home');
    }

    public function showLogin(){
        return view('login');
    }

    public function showRegister(){
        return view('register');
    }
}
