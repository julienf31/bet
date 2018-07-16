<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('profile.index', compact('users'));
    }

    public function show($user_id = null)
    {
        if(isset($user_id)){
            $user = User::find($user_id);
        } else {
            $user = Auth::user();
        }
        return view('profile.show', compact('user'));
    }

    public function edit($user_id = null)
    {
        if(isset($user_id)){
            $user = User::find($user_id);
        } else {
            $user = Auth::user();
        }

        $teams = Team::all();

        return view('profile.edit', compact('user','teams'));
    }

    public function update($user_id = null, Request $request)
    {
        if(isset($user_id)){
            $user = User::find($user_id);
        } else {
            $user = Auth::user();
        }

        $user->favorite_team = $request->get('team');
        $user->theme = $request->get('theme');
        $user->save();

        return redirect(route('profile'));
    }
}
