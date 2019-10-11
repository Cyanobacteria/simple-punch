<?php

namespace App\Http\Controllers;

use App\PuncheRecord;
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
    private function returnHome()
    {

//        return view('home',[
//            'time_data'=>$this->record,
//            'message'=>$this->message
//            ]);
    }

    private function RecordDataJoin($t){

    }

    private function insertRecord($params)
    {
        try {
            $t = new PuncheRecord;
            $t->user_id = $params->user_id;
            $t->shift_type_id  = $params->shift_type_id;
            $t->punch_type_id  = $params->punch_type_id;
            $t->punche_user_id  = $params->punche_user_id;
            $t->status = $params->status;
            $t->remark = $params->remark;
            $t->created_at = now();

            $insertId=$t->save();
        } catch (\Exception $e) {
        return $e;
        }
        return $t;
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $punchetype = $request->{'punche-type'};
        $shiftType = $request->{'shift-type'};
        $result = $this->insertRecord((object)[
         'user_id'=>$user_id,
         'shift_type_id'=>$shiftType,
         'punch_type_id'=>$punchetype,
         'punche_user_id'=>$user_id,
         'status'=>1,
         'remark'=>'',
        ]);
        $message[0]=($result)?'success':$result->getMessage();

        header("location:http://127.0.0.1:8082/home?message={$message[0]}");
        //die();
        //Redirect::to('home', ['message' => $this->message[0]]);
//        die('ff');
        //redirect('/home?message='.$this->message[0]);


    }

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
