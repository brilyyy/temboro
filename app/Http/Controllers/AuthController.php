<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        $remember = $request->rememberme == 'on' ? true : false;

        Auth::attempt($data, $remember);

        if (Auth::check()) {
            return redirect()->route('home.admin');
        } else {
            return redirect()->route('login.admin');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
