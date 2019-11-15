<?php

namespace App\Http\Controllers;

use App\PunchRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WokerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        dd(Auth::user());
        return view('ok');
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

    public function __construct()
    {
        $this->message = [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    //DB動作
    private function insertRecord($params)
    {
        try {
            $t = new PunchRecord;
            $t->user_id = $params->user_id;
            $t->shift_type_id  = $params->shift_type_id;
            $t->punch_type_id  = $params->punch_type_id;
            $t->punch_user_id  = $params->punch_user_id;
            $t->punch_result_id = $params->punch_result_id;
            $t->status = $params->status;
            $t->remark = $params->remark;
            $t->created_at = now();

            $insertId = $t->save();
        } catch (\Exception $e) {
            return $e;
        }
        return $t;
    }
    //通用方法
    //遲到早退驗證器
    private function checkPunchResult($shiftType, $punchType) //班別-上下請假
    {
        //時間比較 - 早於八點-早退 -
        $today = date('Y-m-j');
        $now = now();
        $todayISO = strtotime($today);
        $nowISO = strtotime($now);
        $am09 = 3600 * 9;
        $pm12 = 3600 * 12;
        $pm13 = 3600 * 13;
        $pm18 = 3600 * 18;
        $punchTime = now();
        $result = '';
        $punchResult = '';

        if ($shiftType == 1) { //早班
            //遲到判斷 09
            if ($punchType == 1 && $nowISO > $todayISO + $am09) {
                $result = '遲到';
            } elseif ($punchType == 2 && $nowISO < $todayISO + $pm12) {
                //早退判斷 12
                $result = '早退';
            } else {
                $result = '正常';
            }
        } elseif ($shiftType == 2) { //午班

            //遲到判斷 13
            if ($punchType == 1 && $nowISO > $todayISO + $pm13) {
                $result = '遲到';
            } elseif ($punchType == 2 && $nowISO < $todayISO + $pm18) {
                //早退判斷 18
                $result = '早退';
            } else {
                $result = '正常';
            }
        } elseif ($shiftType == 3) { //全天班
            // dd($shiftType, $punchType, $nowISO, ($todayISO + $pm18), ($nowISO > $todayISO + $pm18));
            //遲到判斷 09
            if ($punchType == 1 && $nowISO > ($todayISO + $am09)) {
                $result = '遲到';
            } elseif ($punchType == 2 && $nowISO < ($todayISO + $pm18)) {
                //早退判斷 18
                $result = '早退';
            } else {
                $result = '正常';
            }
        }

        if ($result == '正常') {
            $punchResult = 3;
        } elseif ($result == '遲到') {
            $punchResult = 1;
        } elseif ($result == '早退') {
            $punchResult = 2;
        }


        return $punchResult;
    }


    public function store(Request $request)
    {
        //取值-存放在＄request  - parameter  - punche-type / shift-type
        $user_id = Auth::user()->id;
        $punchType = $request->{'punch-type'};
        $shiftType = $request->{'shift-type'};
        $punchResult = $this->checkPunchResult($shiftType, $punchType);

        //寫入資料庫
        $result = $this->insertRecord((object) [
            'user_id' => $user_id,
            'shift_type_id' => $shiftType,  //班別
            'punch_type_id' => $punchType, //上班-下班-請假
            'punch_user_id' => $user_id,
            'punch_result_id' => $punchResult, //打卡結果- 遲到-早退-正常
            'status' => 1,
            'remark' => 'water-test',
        ]);




        //提示訊息
        $message[0] = ($result) ? 'success' : $result->getMessage();
        dd($result);
        header("location:http://127.0.0.1:8082/home?message={$message[0]}");

        //die();
        //Redirect::to('home', ['message' => $this->message[0]]);
        //        die('ff');
        //redirect('/home?message='.$this->message[0]);


    }






    //--------------------------------------------------------------------------------------------
    private function returnHome()
    {

        //        return view('home',[
        //            'time_data'=>$this->record,
        //            'message'=>$this->message
        //            ]);
    }

    private function RecordDataJoin($t)
    { }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
