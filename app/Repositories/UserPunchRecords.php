<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPunchRecords
{
    public static function getByPK($params)
    {
        $id = $params['id'];
        $userData = DB::table('punch_records AS a')
            ->select(
                [
                    'a.id as id',
                    'a.user_id as user_id',
                    'a.shift_type_id as shift_type_id',
                    'a.	punch_type_id as 	punch_type_id',
                    'a.punch_user_id as punch_user_id',
                    'a.	punch_result_id	 as 	punch_result_id	',
                    'a.	status as 	status',
                    'a.remark as remark',
                    'a.created_at as created_at',
                    'a.updated_at as updated_at',
                ]
            )->where('a.user_id', $id)
            ->get();

        return $userData;
    }


    public static function getByTimeRange($params)
    {

        $start = $params['start'];
        $end = $params['end'];

        $todayPunchRecord = DB::table('punch_records AS a')
            ->select(
                [ //a - punch_records   打卡紀錄 |    b-punch_types 上下班假 |  c-shift_types 班別
                    'a.created_at as time', // a - punch_records   打卡紀錄 建立時間
                    'b.id as actionId', //b-punch_types  班類型ID
                    'b.name as action',  //b-punch_types  班別名稱
                    'c.start as start',   // c-shift_types 班別  起始時間
                    'c.end as end',   // c-shift_types 班別 結束時間
                    'c.name as shift',   // c-shift_types 班別  名稱
                    'c.id as shiftId',   // c-shift_types 班別    ID
                    'a.remark as remark' // a-remark 備註
                ]
            )
            ->whereBetween('a.created_at', [$start, $end])  //條件 - 打卡紀錄之起始時間 - 符合指定條件
            ->where('a.user_id', Auth::user()->id) //條件 - 打卡紀錄之userID - 符合指定條件
            ->leftJoin('punch_types AS b', 'b.id', '=', 'a.punch_type_id')  // Join - b-punch_types 上下班假
            ->leftJoin('shift_types AS c', 'c.id', '=', 'a.shift_type_id') // Join - c-shift_types 班別
            ->get();  //取得資料


        return $todayPunchRecord;
    }

    //與上方相同-差異是可以指定userID
    public static function getByTimeRangeAndUserId($params)
    {

        $start = $params['start'];
        $end = $params['end'];
        $userId = $params['userId'];

        $todayPunchRecord = DB::table('punch_records AS a')
            ->select(
                [ //a - punch_records   打卡紀錄 |    b-punch_types 上下班假 |  c-shift_types 班別
                    'a.user_id as userId', // a - remark  打卡紀錄 打卡結果欄位
                    'a.id as punchRecordId', // a - remark  打卡紀錄 打卡結果欄位
                    'a.punch_result_id as punchResultId', // a - remark  打卡紀錄 打卡結果欄位
                    'a.remark as remark', // a - remark  打卡紀錄 備註欄位
                    'a.created_at as time', // a - punch_records   打卡紀錄 建立時間
                    'b.id as actionId', //b-punch_types  班類型ID
                    'b.name as action',  //b-punch_types  班別名稱
                    'c.start as start',   // c-shift_types 班別  起始時間
                    'c.end as end',   // c-shift_types 班別 結束時間
                    'c.name as shift',   // c-shift_types 班別  名稱
                    'c.id as shiftId',   // c-shift_types 班別    ID
                ]
            )
            ->whereBetween('a.created_at', [$start, $end])  //條件 - 打卡紀錄之起始時間 - 符合指定條件
            ->where('a.user_id', $userId) //條件 - 打卡紀錄之userID - 符合指定條件
            ->leftJoin('punch_types AS b', 'b.id', '=', 'a.punch_type_id')  // Join - b-punch_types 上下班假
            ->leftJoin('shift_types AS c', 'c.id', '=', 'a.shift_type_id') // Join - c-shift_types 班別
            ->get();  //取得資料


        return $todayPunchRecord;
    }
}
