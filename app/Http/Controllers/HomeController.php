<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $redirectTo = 'user/dashboard';
        switch(Auth::user()->role_id){
            case 1 : $redirectTo = 'admin/dashboard';break;
            case 3 : $redirectTo = 'teacher/dashboard';break;
            case 4 : $redirectTo = 'user/dashboard';break;
        }
        return redirect($redirectTo);
        // return view('home');
    }
}
