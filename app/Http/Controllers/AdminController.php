<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//service
use App\Services\Format;
//Facades
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    //檢視 -管理者打卡頁面
    public function home()
    {
        //
        $records = Format::index();
        return view('adminHome', ['now' => now(), 'records' => $records, 'message' => []]);
    }
    //j管理者檢視自己的打卡紀錄
    public function record(Request $request)
    {
        dump($request->month);
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




    //檢視 -管理者打卡
    public function punch()
    {
        // 功能跟worker 重複 - 暫時不新增
    }




    //----------------------------------------------------------------------
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
