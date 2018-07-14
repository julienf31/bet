<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($user_id = null)
    {
        if(isset($user_id)){
            $user = User::find($user_id);
        } else {
            $user = Auth::user();
        }
        return view('profile.show', compact('user'));
    }
}
