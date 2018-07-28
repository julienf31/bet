<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Toastr;
use Lang;

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

        $validator = Validator::make($request->all(),array(
            'firstname'                 => 'required|max:255',
            'lastname'                  => 'required|max:255',
            'email'                     => 'required|email|max:255|unique:users,email,'.$user->id,
            'pseudo'                    => 'required|min:3|max:30|unique:users,pseudo,'.$user->id,
        ));


        if ($validator->fails()) {
            Toastr::error(Lang::get('error'), $title = Lang::get('error'), $options = []);
            return back()->withErrors($validator)->withInput();
        } else {
            $user->email = $request->get('email');
            $user->pseudo = $request->get('pseudo');
            $user->favorite_team = $request->get('team');
            $user->theme = $request->get('theme');

            if($request->get('send_mail')){
                $user->send_mail = TRUE;
            } else {
                $user->send_mail = FALSE;
            }

            if($request->get('role') != null){
                $user->role = $request->get('role');
            }

            $user->save();
        }

        return redirect(route('profile',$user_id));
    }
}
