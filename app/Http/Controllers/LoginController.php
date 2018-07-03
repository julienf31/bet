<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

        $fisrtname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $email = $request->get('email');
        $password = $request->get('password');
        $passwordConfirm = $request->get('passwordConfirm');

        $validator = Validator::make($request->all(),array(
            'email'                 => 'required|email|max:255',
            'password'              => 'required|min:6|max:20|confirmed',
            'passwordConfirm'              => 'required|min:6|max:20',
        ));


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }else{
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                // Authentication passed...
                return redirect()->intended('home');
            }
            else{
                return redirect('login')->withErrors(['loginError' => 'Mauvais identifiants'])->withInput();
            }
        }
    }

    public function logout(){
        Auth::logout();
        Toastr::success(Lang::get('generic.disconnect_confirm'), $title = Lang::get('generic.disconnect'), $options = []);
        return redirect('home');
    }
}
