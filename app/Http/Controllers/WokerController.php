<?php

namespace App\Http\Controllers;


use App\PunchRecord;
use App\PunchRecordHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

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


    public function store(Request $request)
    {
        //取值-存放在＄request  - parameter  - punche-type / shift-type
        $punchData = array(
            'user_id' => Auth::user()->id,
            'shift_type_id' => $request->{'shift-type'},  //班別
            'punch_type_id' => $request->{'punch-type'}, //上班-下班-請假
            'punch_user_id' => Auth::user()->id,
            'punch_result_id' => $request->{'punchResult'}, //打卡結果- 遲到-早退-正常
            'status' => 1,
            'remark' => $request->{'remark'} ? $request->{'remark'} : '',
        );
        /*
        $mail_binding = ['nickname' => 'water'];
        //如果有遲到-寄信通知
        if ($request->{'remark'}) {
            Mail::send('emails', $mail_binding, function ($message) {
                $message->from('azsx96385water@gmail.com', 'water');
                $message->to('azsx96385@gmail.com');
                $message->subject('water test');
                $message->attach(base_path('storage/app/users.xlsx'));
            });
        }
        //excel 匯出
        Excel::store(new UsersExport, 'users.xlsx');
*/
        //寫入DB- punchRecord

        $result = $this->insertRecord((object) $punchData);

        //寫入DB- punchHistory - json 化
        PunchRecordHistory::create([
            'punch_record_id' => $result->id,
            'raw_data' => json_encode((object) $punchData),
            'updated_at' => now()
        ]);

        //提示訊息
        $message[0] = ($result) ? 'success' : $result->getMessage();
        //echo ($result->id);
       return redirect()->route('home',['message' => $message[0]]);

    }

    //取得使用者-月份紀錄
    public function getUserRecords(Request $request)
    {
        dump($request->month);
        $records = Format::month($request->month);

        $month = DB::table('punch_records as a')
            ->select('a.created_at as date')
            ->get();

        $newAry = [];

        foreach ($month as $k => $v) {
            $date = new \DateTime($v->date);
            $newAry[] = $date->format("Y-m");
        }

        $month = array_unique($newAry);

        return view('read', ['month' => $month, 'now' => now(), 'records' => $records, 'message' => []]);
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
