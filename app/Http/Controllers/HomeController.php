<?php

namespace App\Http\Controllers;

use App\punchRecord;
use App\Services\Format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $records=Format::index();
        return view('home', ['now' => now(), 'records' => $records, 'message' => []]);
    }
}
