<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//model
//user model
use App\User;
use App\PunchRecord;
use App\PunchRecordHistory;

//service
use App\Services\Format;
//Facades
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//repo
use App\Repositories\UserPunchRecords;


class AdminController extends Controller
{
    public function __construct()
    {


        $userData = Auth::user();

        if ($userData['isAmin'] == 1) {
            return redirect('/home');
        }
        // $this->middleware('auth');
    }




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

    //管理者檢視所有員工紀錄
    public function workerRecord(Request $request)
    {

        //1.調出員工清單    - user table  - isAdmim ==0
        $workerIdList = [];
        $workers = User::where('isAdmin', 0)->get();
        foreach ($workers as $user) {
            $workerIdList[$user->id] = $user->name;
        }

        //2.1取出所有員工打卡紀錄
        $workersPunchData = [];
        //迴圈調用使用者資料-建立資料物件 userId =>[  ''name' =>water ,''monthData'=>[xxx]] 
        foreach ($workerIdList as $workerId => $workerName) {

            $monthParams = ['month' => $request->month, 'userId' => $workerId];
            //1.取出使用者該月份紀錄
            $records = Format::monthByUserId($monthParams);
            //2.初始化資料結構
            //name
            $workersPunchData[$workerId]['name'] = $workerName;
            //monthData
            $workersPunchData[$workerId]['monthData'] = $records;
            //hours
            $workersPunchData[$workerId]['totalSecond'] = 0;
            //workDay  實際工作日
            $workersPunchData[$workerId]['workDay'] = 0;
            //shift 班表數
            $workersPunchData[$workerId]['shift']['allDay'] = 0;
            $workersPunchData[$workerId]['shift']['morning'] = 0;
            $workersPunchData[$workerId]['shift']['afternoon'] = 0;
            //late 遲到
            $workersPunchData[$workerId]['late']['count'] = 0;
            $workersPunchData[$workerId]['late']['data'] = [];
            //leaveEarly 早退
            $workersPunchData[$workerId]['leaveEarly']['count'] = 0;
            $workersPunchData[$workerId]['leaveEarly']['data'] = [];
            //leave 請假
            $workersPunchData[$workerId]['leave']['count'] = 0;
            $workersPunchData[$workerId]['leave']['data'] = [];
            //other 異常值
            $workersPunchData[$workerId]['other']['count'] = 0;
            $workersPunchData[$workerId]['other']['data'] = [];

            //3.格式化-使用者月份紀錄
            foreach ($records as $date => $dailyData) {
                //條件- 正常情況-當天必須有上下班打卡紀錄  
                if (count($dailyData) == 2) {
                    $workersPunchData[$workerId]['workDay']++;
                    //1.計算全天班 / 早班 /午班  次數
                    switch ($dailyData[0]->shiftId) {
                        case '1': //早班
                            $workersPunchData[$workerId]['shift']['morning']++;
                            break;
                        case '2': //午班
                            $workersPunchData[$workerId]['shift']['afternoon']++;
                            break;
                        case '3': //全天班
                            $workersPunchData[$workerId]['shift']['allDay']++;
                            break;
                    }

                    //2.計算相差秒數 並累積
                    $workersPunchData[$workerId]['totalSecond'] = $workersPunchData[$workerId]['totalSecond'] + (strtotime($dailyData[1]->time) - strtotime($dailyData[0]->time));

                    //3.1.計算遲到次數 ｜ 條件-檢查 monthData - index 0 -  result  == "遲到" ｜ 計算次數  且  將資料存到 遲到紀錄區
                    //3.2計算早退次數 ｜ 條件-檢查 monthData - index 0 -  result  == "早退"｜ 計算次數  且  將資料存到 早退紀錄區

                    switch ($dailyData[0]->punchResultId) {
                        case '1':
                            $workersPunchData[$workerId]['late']['count']++;
                            $workersPunchData[$workerId]['late']['data'][$date] = $dailyData[0] ? $dailyData[0] : $dailyData[1];
                            break;
                        case '2':
                            $workersPunchData[$workerId]['leaveEarly']['count']++;
                            $workersPunchData[$workerId]['leaveEarly']['data'][$date] = $dailyData[0] ? $dailyData[0] : $dailyData[1];
                            break;
                    }
                } else {
                    //請假 ＆ 異常值判斷
                    //3.2 計算請假次數 ｜ 條件-檢查 monthData - index 0 -  actionId  !== 1  &&  !== 2   ｜ 檢查 monthData - index 0 -  actionId  === 1  ||  === 2 - 則為異常資料 - 存到異常資料區  
                    if ($dailyData[0]->actionId > 2) {
                        $workersPunchData[$workerId]['leave']['count']++;
                        $workersPunchData[$workerId]['leave']['data'][$date] = $dailyData[0] ? $dailyData[0] : $dailyData[1];
                    } else {
                        $workersPunchData[$workerId]['other']['count']++;
                        $workersPunchData[$workerId]['other']['data'][$date] = $dailyData[0] ? $dailyData[0] : $dailyData[1];
                    }
                }
            }
        }
        //3.計算使用者工作時數
        foreach ($workersPunchData as $workId => $workerFormatData) {
            $fullDayCount = $workerFormatData['shift']['allDay'];
            $workersPunchData[$workId]['hours'] = round(($workerFormatData['totalSecond'] - 60 * 60 * $fullDayCount) / 3600);
        }
        dump($workersPunchData);



        //4.取月份為一值-當作下拉選單
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


        //逐一整理資料 ｜ 總時數 - 遲到-早退-請假 ｜ 狀態-時間-事由
        return view('readWorks', ['month' => $month, 'now' => now(), 'workersPunchData' => $workersPunchData, 'records' => $records, 'message' => []]);
    }


    public function updatedRecord(Request $request)
    {
        // 取得更新值-建立更新物件
        $punchRecordId = $request->{'punchid'};
        $punchResult = $request->{'workpunchresult'};
        $punchRemark =  $request->{'workpunchremark'};
        $adminData = Auth::user();

        if ($adminData->isAdmin == 1) {
            //調出更動之record
            $record = PunchRecord::where('id', $punchRecordId)
                ->update(['punch_user_id' => $adminData->id, 'punch_result_id' => $punchResult, 'remark' => $punchRemark, 'updated_at' => now()]);

            $updatedData = PunchRecord::where('id', $punchRecordId)->get()[0];
            $punchHistoryData = array(
                'id' => $updatedData->id,
                'user_id' => $updatedData->user_id,
                'shift_type_id' => $updatedData->shift_type_id,  //班別
                'punch_type_id' => $updatedData->punch_type_id, //上班-下班-請假
                'punch_user_id' => $updatedData->punch_user_id,
                'punch_result_id' => $updatedData->punch_result_id, //打卡結果- 遲到-早退-正常
                'status' => $updatedData->status,
                'remark' => $updatedData->remark,
                'created_at' => $updatedData->created_at,
                'updated_at' => $updatedData->updated_at
            );
            //寫入DB- punchHistory - json 化 
            PunchRecordHistory::create([
                'punch_record_id' => $updatedData->id,
                'raw_data' => json_encode((object) $punchHistoryData),
                'updated_at' => now()
            ]);
        };

        return redirect()->back();
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
