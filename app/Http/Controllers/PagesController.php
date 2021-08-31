<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function indexAdmin()
    {
        if (Auth::check()) {
            return view('dashboard.index');
        }
        return redirect()->route('login.admin');
    }
    public function login()
    {
        return view('dashboard.auth.login');
    }
}
