<?php

namespace App\Http\Controllers;

use App\punchRecord;
use App\PunchResult;
use App\PunchType;
use App\Services\Format;
use App\ShiftType;
use App\Statuses;
use App\User;
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
        //dump(Auth::user());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $shift_types = ShiftType::all();
        $records = Format::index();
        return view('home', ['now' => now(), 'records' => $records, 'message' => [], 'shift_types' => $shift_types]);
    }

    public function read(Request $request)
    {
        //dump($request->month);
        //取出打卡紀錄

        $monthParams = ['month' => $request->month,];
        $sMonth = [];
        Session::put('requestMonth', $monthParams['month']);

        //取出Session值，如果值為空的話則回傳default
        $sMonth = Session::get('requestMonth', function () {
            return 'default';
        });

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

        // dd($records);
        return view('read', ['month' => $month, 'now' => now(), 'records' => $records, 'message' => [],'sMonth' => $sMonth,]);
    }

}
