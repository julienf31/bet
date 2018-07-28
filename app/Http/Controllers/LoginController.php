<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Toastr;
use Validator;


class LoginController extends BaseController
{

    public function login(Request $request){

        $email = $request->get('email');
        $password = $request->get('password');

        $validator = Validator::make($request->all(),array(
                'email'                 => 'required|max:255',
                'password'              => 'required|min:6|max:20',
        ));


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }else{
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                Toastr::success(Lang::get('generic.connect_confirm'), $title = Lang::get('generic.connect'), $options = []);
                return redirect()->intended('home');
            }elseif(Auth::attempt(['pseudo' => $email, 'password' => $password])){
                Toastr::success(Lang::get('generic.connect_confirm'), $title = Lang::get('generic.connect'), $options = []);
                return redirect()->intended('home');
            }
            else{
                return redirect('login')->withErrors(['loginError' => 'Mauvais identifiants'])->withInput();
            }
        }
    }

    public function register(Request $request){

        $firstname = ucfirst(strtolower($request->get('firstname')));
        $lastname = strtoupper($request->get('lastname'));
        $pseudo = strtolower($request->get('pseudo'));
        $email = strtolower($request->get('email'));
        $password = $request->get('password');

        $validator = Validator::make($request->all(),array(
            'firstname'                 => 'required|max:255',
            'lastname'                  => 'required|max:255',
            'email'                     => 'required|unique:users,email|email|max:255',
            'pseudo'                    => 'required|unique:users,pseudo|min:3|max:30',
            'password'                  => 'required|min:6|max:20|confirmed',
            'password_confirmation'     => 'required|min:6|max:20',
        ));


        if ($validator->fails()) {
            Toastr::error(Lang::get('generic.connect_confirm'), $title = Lang::get('generic.connect'), $options = []);
            return back()->withErrors($validator)->withInput();
        }else{
            $user = new User();
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->pseudo = $pseudo;
            $user->theme = 'blue';
            $user->password = Hash::make($password);
            $user->group_id = 2;
            $user->save();

            Toastr::success(Lang::get('generic.register_confirm'), $title = Lang::get('generic.register'), $options = []);
            return redirect('home');
        }
    }

    public function logout(){
        Auth::logout();
        Toastr::success(Lang::get('generic.disconnect_confirm'), $title = Lang::get('generic.disconnect'), $options = []);
        return redirect('home');
    }
}
