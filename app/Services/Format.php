<?php


namespace App\Services;


use App\Repositories\UserPuncheRecords;
use Illuminate\Support\Facades\DB;

class Format
{
    //多日打卡紀錄，可以拆分成多個每日進行，最後再合併即可
    private static function indexTreeStructure($todayPunchRecord)
    {
        $shiftAry = [];
        $actionAry = [];
        foreach ($todayPunchRecord as $k => $v) {
            $shiftAry[] = $v->shiftId;
            $actionAry[] = $v->actionId;
        }
        $shiftAry = array_unique($shiftAry);
        $actionAry = array_unique($actionAry);
        $shiftIdAry = [];
        $actionIdAry = [];

        foreach ($shiftAry as $k => $v) {
            $shiftIdAry[$v] = [];
        }
        foreach ($actionAry as $k => $v) {
            $actionIdAry[$v] = [];
        }
        foreach ($shiftIdAry as $k => &$v) {
            $v = $actionIdAry;
        }
        return self::indexFillTree($todayPunchRecord, $shiftIdAry);
    }

    private static function indexFillTree($todayPunchRecord, $shiftIdAry)
    {
        foreach ($todayPunchRecord as $k => &$v) {
            $start = new \DateTime($v->start);
            $start = $start->getTimestamp();
            $end = new \DateTime($v->end);
            $end = $end->getTimestamp();
            $time = new \DateTime($v->time);
            $time = $time->getTimestamp();
            $actionType = $v->actionId;
            $shiftType = $v->shiftId;
            $currentCompare = &$shiftIdAry[$shiftType][$actionType];
            $stE = '早退';
            $stL = '遲到';
            $stN = '正常';
            switch ($actionType) {
                case '1':
                    $v->result = ($time < $start) ? $stN : $stL;
                    break;

                case '2':
                    $v->result = ($time < $end) ? $stE : $stN;
                    break;
                case '3':

                    break;
            }

            if ($currentCompare == []) {
                $currentCompare = $v;
            } else {
                $currentCompareTime = new \DateTime($currentCompare->time);
                $currentCompareTime = $currentCompareTime->getTimestamp();
                if ($actionType == 1 and $currentCompareTime > $time) {
                    $currentCompare = $v;
                }
                if ($actionType == 2 and $currentCompareTime < $time) {
                    $currentCompare = $v;
                }
            }

        }
        return self::indexfilterAndFlat($shiftIdAry);

    }

    private static function indexfilterAndFlat($shiftIdAry)
    {
        $newAry = [];
        //dump($shiftIdAry);
        foreach ($shiftIdAry as $k => $v) {

            $newAry = array_merge($newAry, $v);
        }
        $shiftIdAry = $newAry;
        //dd($shiftIdAry);
        while (($key = array_search([], $shiftIdAry))) {
            unset($shiftIdAry[$key]);
        }
        return $shiftIdAry;
    }


    public static function index()
    {

        $today = date('Y-m-d');
        $todayPunchRecord = UserPuncheRecords::getByTimeRange([
            'start' => $today . ' 00-00-00',
            'end' => $today . ' 23-59-59',
        ]);
        //dd($todayPunchRecord);
        if ($todayPunchRecord->isNotEmpty()) {
            $shiftIdAry = self::indexTreeStructure($todayPunchRecord);
        }
        //dd($shiftIdAry, $todayPunchRecord);
        $records = (!isset($shiftIdAry)) ? null : $shiftIdAry;
        //dd($records);
        return $records;

    }

    public static function month($params)
    {
        $month = $params;
        $start = $month . '-1 00:00:00';
        $end = $month . '-31 23:59:59';
//        dd($params);
        $monthPunchRecord = UserPuncheRecords::getByTimeRange([
            'start' => $start,
            'end' => $end,
        ]);
        $daysAry = [];
        foreach ($monthPunchRecord as $k => &$v) {
            $ori = new \DateTime($v->time);
            $day = $ori->format('Y-m-d');
            $daysAry[$day] = [];
            $v->day = $day;
        }
        foreach ($monthPunchRecord as $k => $v) {
            $daysAry[$v->day][] = $v;
        }
        foreach ($daysAry as $k => &$v) {
            if (count($v) > 0) {
                $shiftIdAry = self::indexTreeStructure($v);
                $v = $shiftIdAry;
            }

        }

        return $daysAry;


    }


}
