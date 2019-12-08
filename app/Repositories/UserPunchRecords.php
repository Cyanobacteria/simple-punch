<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPunchRecords
{
    public static function getByTimeRange($params){

        $start=$params['start'];
        $end=$params['end'];

        $todayPunchRecord = DB::table('punch_records AS a')
            ->select(
                [
                    'a.created_at as time',
                    'b.name as action',
                    'c.start as start',
                    'c.end as end',
                    'c.name as shift',
                    'c.id as shiftId',
                    'b.id as actionId'
                ]
            )
            ->whereBetween('a.created_at', [$start, $end])
            ->where('a.user_id',Auth::user()->id)
            ->leftJoin('punch_types AS b', 'b.id', '=', 'a.punch_type_id')
            ->leftJoin('shift_types AS c', 'c.id', '=', 'a.shift_type_id')
            ->get();


        return $todayPunchRecord;

    }

}
