<?php

namespace App\Http\Controllers;

use App\User_time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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


        $data=User_time::where('name','=',Auth::user()->name)->get();
        $allRecord=User_time::orderBy('created_at')
            ->orderBy('status')
            ->get();

        return view('home',['time_data'=>$data,'allRecord'=>$allRecord,'message'=>[]]);
    }
}
