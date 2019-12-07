<?php


namespace App\Services;


use App\Repositories\UserPunchRecords;
use Illuminate\Support\Facades\DB;

class Format
{
    //多日打卡紀錄，可以拆分成多個每日進行，最後再合併即可
    private static function indexTreeStructure($todayPunchRecord)
    {
        $shiftAry = [];
        $actionAry = [];

        //收集班別ID  &  班類型ID
        foreach ($todayPunchRecord as $k => $v) {
            $shiftAry[] = $v->shiftId;
            $actionAry[] = $v->actionId;
        }
        //  dump($shiftAry);
        //取不重複值
        $shiftAry = array_unique($shiftAry);
        $actionAry = array_unique($actionAry);
        $shiftIdAry = [];
        $actionIdAry = [];

        foreach ($shiftAry as $k => $v) {
            $shiftIdAry[$v] = [];
        }
        //dump($shiftIdAry);
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
           // $start = new \DateTime($v->start);
           // $start = $start->getTimestamp();
            $start = $v->start ;
           // $end = new \DateTime($v->end);
          //  $end = $end->getTimestamp();
            $end = $v->end ;
            //$time = new \DateTime($v->time);
            $time =date('H:i:s', strtotime($v->time));
          //  $time = $time->getTimestamp();
            $remark = $v->remark;
            $actionType = $v->actionId;
            $shiftType = $v->shiftId;
            $currentCompare = &$shiftIdAry[$shiftType][$actionType];
            $stE = '早退';
            $stL = '遲到';
            $stN = '正常';
            $stO = '請假';

            switch ($v->actionId) {
                case '1': //上班
                    $v->result = ($time > $start ) ? $stL : $stN;
                    break;
                case '2': //下班
                    $v->result = ($time > $end) ? $stN : $stE;
                    break;
                case '3':
                    $v->result = $stO;
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
        //取得使用者 - 當天所有紀錄
        $todayPunchRecord = UserPunchRecords::getByTimeRange([
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
        //設定區間
        $start = $month . '-1 00:00:00';
        $end = $month . '-31 23:59:59';
        //dd($params);

        //調用資料-使用自訂sql 語法
        $monthPunchRecord = UserPunchRecords::getByTimeRange([
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

    //與上方相同-差亦是可以指定userId
    public static function monthByUserId($params)
    {

        $month = $params['month'];
        $userId = $params['userId'];
        //設定區間
        $start = $month . '-1 00:00:00';
        $end = $month . '-31 23:59:59';


        //調用資料-使用自訂sql 語法
        $monthPunchRecord = UserPunchRecords::getByTimeRangeAndUserId([
            'start' => $start,
            'end' => $end,
            'userId' => $userId
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
