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

        $records = Format::index();
        return view('home', ['now' => now(), 'records' => $records, 'message' => []]);
    }

    public function read(Request $request)
    {
        //dump($request->month);
        //取出打卡紀錄
        $records = Format::month($request->month);
        //取月份
        $month = DB::table('punch_records as a')
            ->select('a.created_at as date')
            ->get();

        $newAry = [];
        //格式化-月份
        foreach ($month as $k => $v) {
            $date = new \DateTime($v->date);
            $newAry[] = $date->format("Y-m");
        }
        //取唯一值
        $month = array_unique($newAry);
        return view('read', ['month' => $month, 'now' => now(), 'records' => $records, 'message' => []]);
    }
}
