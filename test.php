<?


function getWeekDay($time)
{
    return date('w', strtotime($time));
}

function getD($time)
{
    return date('Y-m-d', strtotime($time));
}

function getHis($time)
{
    return date('H:i:s', strtotime($time));
}

function getStrToTime($time)
{
    return strtotime($time);
}

$ary_1 = [
    '羅名宏' => [
        1 => 0,
        2 => 2,
        3 => null,
        4 => 2,
        5 => 1,
    ],
    '徐子洋' => [
        1 => null,
        2 => 1,
        3 => 2,
        4 => 1,
        5 => null,
    ],
    '蔡名皓' => [
        1 => null,
        2 => null,
        3 => 2,
        4 => 1,
        5 => null,
    ],


];
$ary_2 = [
    '羅名宏' => [
        'total' => [],
        'days' => []
    ],
    '徐子洋' => [
        'total' => [],
        'days' => []
    ],
    '蔡名皓' => [
        'total' => [],
        'days' => []
    ],
];
$classTypeMap = [
    [
        's' => '09:00:00',
        'e' => '12:00:00',
    ],
    [
        's' => '13:30:00',
        'e' => '18:00:00',
    ],
    [
        's' => '09:00:00',
        'e' => '18:00:00',
    ]


];
$user_time = array(
    array('id' => '749', 'name' => '羅名宏', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-01 8:55:02', 'updated_at' => '2019-10-01 10:33:02'),
    array('id' => '750', 'name' => '徐子洋', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-01 13:04:56', 'updated_at' => '2019-10-01 13:04:56'),
    array('id' => '751', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-01 18:11:59', 'updated_at' => '2019-10-01 18:11:59'),
    array('id' => '752', 'name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-01 18:35:27', 'updated_at' => '2019-10-01 18:35:27'),
    array('id' => '753', 'name' => '徐子洋', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-02 09:01:48', 'updated_at' => '2019-10-02 09:01:48'),
    array('id' => '754', 'name' => '蔡名皓', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-02 09:08:50', 'updated_at' => '2019-10-02 09:08:50'),
    array('id' => '755', 'name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-02 18:00:35', 'updated_at' => '2019-10-02 18:00:35'),
    array('id' => '756', 'name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-02 19:56:42', 'updated_at' => '2019-10-02 19:56:42'),
    array('id' => '757', 'name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-03 09:02:28', 'updated_at' => '2019-10-03 09:02:28'),
    array('id' => '758', 'name' => '徐子洋', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-03 14:06:46', 'updated_at' => '2019-10-03 14:06:46'),
    array('id' => '759', 'name' => '蔡名皓', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-03 15:38:12', 'updated_at' => '2019-10-03 15:38:12'),
    array('id' => '760', 'name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-03 18:05:07', 'updated_at' => '2019-10-03 18:05:07'),
    array('id' => '761', 'name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-03 18:11:42', 'updated_at' => '2019-10-03 18:11:42'),
    array('id' => '762', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-03 18:13:52', 'updated_at' => '2019-10-03 18:13:52'),
    array('id' => '763', 'name' => '羅名宏', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-04 13:03:20', 'updated_at' => '2019-10-04 13:03:20'),
    array('id' => '764', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-04 18:04:53', 'updated_at' => '2019-10-04 18:04:53'),
    array('id' => '765', 'name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-08 08:49:07', 'updated_at' => '2019-10-08 08:49:07'),
    array('id' => '766', 'name' => '徐子洋', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-08 13:00:14', 'updated_at' => '2019-10-08 13:00:14'),
    array('id' => '767', 'name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-08 18:06:59', 'updated_at' => '2019-10-08 18:06:59'),
    array('id' => '768', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-08 18:10:52', 'updated_at' => '2019-10-08 18:10:52'),
    array('id' => '769', 'name' => '徐子洋', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-09 09:04:00', 'updated_at' => '2019-10-09 09:04:00'),
    array('id' => '770', 'name' => '蔡名皓', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-09 09:20:49', 'updated_at' => '2019-10-09 09:20:49'),
    array('id' => '771', 'name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-09 18:00:40', 'updated_at' => '2019-10-09 18:00:40'),
    array('id' => '772', 'name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-09 18:03:18', 'updated_at' => '2019-10-09 18:03:18'),
    array('id' => '773', 'name' => '倪坤哲', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-10 15:39:15', 'updated_at' => '2019-10-10 15:39:15'),
    array('id' => '774', 'name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-15 08:50:57', 'updated_at' => '2019-10-15 08:50:57'),
    array('id' => '775', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-15 18:02:54', 'updated_at' => '2019-10-15 18:02:54'),
    array('id' => '776', 'name' => '徐子洋', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-16 09:02:22', 'updated_at' => '2019-10-16 09:02:22'),
    array('id' => '777', 'name' => '蔡名皓', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-16 09:24:36', 'updated_at' => '2019-10-16 09:24:36'),
    array('id' => '778', 'name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-16 18:04:35', 'updated_at' => '2019-10-16 18:04:35'),
    array('id' => '779', 'name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-16 18:10:55', 'updated_at' => '2019-10-16 18:10:55'),
    array('id' => '780', 'name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-17 08:48:23', 'updated_at' => '2019-10-17 08:48:23'),
    array('id' => '781', 'name' => '蔡名皓', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-17 15:36:00', 'updated_at' => '2019-10-17 15:36:00'),
    array('id' => '782', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-17 18:09:31', 'updated_at' => '2019-10-17 18:09:31'),
    array('id' => '783', 'name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-17 18:27:29', 'updated_at' => '2019-10-17 18:27:29'),
    array('id' => '784', 'name' => '羅名宏', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-18 12:51:04', 'updated_at' => '2019-10-18 12:51:04'),
    array('id' => '785', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-18 18:02:36', 'updated_at' => '2019-10-18 18:02:36'),
    array('id' => '786', 'name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-22 09:00:00', 'updated_at' => '2019-10-22 09:10:45'),
    array('id' => '787', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-22 18:07:48', 'updated_at' => '2019-10-22 18:07:48'),
    array('id' => '788', 'name' => '徐子洋', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-23 09:03:19', 'updated_at' => '2019-10-23 09:03:19'),
    array('id' => '789', 'name' => '蔡名皓', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-23 09:37:21', 'updated_at' => '2019-10-23 09:37:21'),
    array('id' => '790', 'name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-23 18:01:45', 'updated_at' => '2019-10-23 18:01:45'),
    array('id' => '791', 'name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-23 18:03:55', 'updated_at' => '2019-10-23 18:03:55'),
    array('id' => '792', 'name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-24 08:55:02', 'updated_at' => '2019-10-24 08:55:02'),
    array('id' => '793', 'name' => '蔡名皓', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-24 15:46:01', 'updated_at' => '2019-10-24 15:46:01'),
    array('id' => '794', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-24 18:12:53', 'updated_at' => '2019-10-24 18:12:53'),
    array('id' => '795', 'name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-24 18:27:49', 'updated_at' => '2019-10-24 18:27:49'),
    array('id' => '796', 'name' => '羅名宏', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-25 13:25:56', 'updated_at' => '2019-10-25 13:25:56'),
    array('id' => '797', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-25 18:02:40', 'updated_at' => '2019-10-25 18:02:40'),
    array('id' => '798', 'name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-28 08:48:23', 'updated_at' => '2019-10-28 08:48:23'),
    array('id' => '799', 'name' => '羅名宏', 'status' => '下班', 'detail' => '異常', 'created_at' => '2019-10-28 12:01:51', 'updated_at' => '2019-10-28 12:01:51'),
    array('id' => '800', 'name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-07 09:00:00', 'updated_at' => '2019-10-07 18:13:52'),
    array('id' => '801', 'name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-07 12:00:00', 'updated_at' => '2019-10-07 18:13:52'),
);
$new_ary = [];
//array('id' => '749', 'name' => '羅名宏', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-01 10:33:02', 'updated_at' => '2019-10-01 10:33:02'),
foreach ($user_time as $k => $v) {
    $weekDay = getWeekDay($v['created_at']);
    $dateMain = getD($v['created_at']);
    if ($v['status'] == '上班') {
        $c = 0;
        foreach ($user_time as $k2 => $v2) {
            $dateSub = getD($v2['created_at']);

            if ($dateMain == $dateSub && $v['name'] == $v2['name']) {
                $c++;
                if ($c > 1 && $v2['status'] == '下班') {
                    $timeS = getHis($v['created_at']);
                    $timeE = getHis($v2['created_at']);


                    $date = $dateMain;
                    $timeRange = $classTypeMap[$ary_1[$v['name']][$weekDay]];
                    $start = $timeRange['s'];
                    $end = $timeRange['e'];
                    //echo $dateMain;
                    $resS = '';
                    $resE = '';
//                    echo PHP_EOL;
//                    echo $start;
//                    echo PHP_EOL;
//                    echo $end;
//                    echo PHP_EOL;
//                    echo '----------------------';

                    if (getStrToTime($start) > getStrToTime($timeS)) {
                        $resS = $start;
                    } else {
                        $resS = $timeS;
                    }
                    if (getStrToTime($end) > getStrToTime($timeE)) {
                        $resE = $timeE;
                    } else {
                        $resE = $end;
                    }
                    $resRange = date('H:i:s', getStrToTime($resE) - getStrToTime($resS));
//                    if(explode(':',$resRange)[0]==23){
//                        echo PHP_EOL;
//                        echo $start;
//                        echo PHP_EOL;
//                        echo $end;
//                        echo PHP_EOL;
//                        echo $resS;
//                        echo PHP_EOL;
//                        echo $resE;
//                        echo PHP_EOL;
//                        echo '---------';
//                        echo $resRange;
//                        echo PHP_EOL;
//                        echo $v['status'];
//                        echo $v2['status'];
//                        echo PHP_EOL;
//                        echo $v['created_at'];
//                        echo $v2['created_at'];
//                        echo PHP_EOL;
//                        echo $timeS;
//                        echo $timeE;
//                        echo PHP_EOL;
//                    }

                    if($ary_1[$v['name']][$weekDay] == '2')
                    {
                        $splitTime=explode(':',$resRange);
                        foreach ($splitTime as $k3=>&$v3){
                            $v3= (int)$v3;
                        }
                        $splitTime[0]=$splitTime[0]-1;
                        //var_dump($splitTime[0]);
                        $s=$splitTime;
                        $resRange="$s[0]:$s[1]:$s[2]";
                        //var_dump($splitTime[0]);
                        //var_dump($resRange);


                    }
                    //var_dump($resRange);

//                    echo $resE;
//                    echo PHP_EOL;

//                    echo PHP_EOL;
//                    echo $resS;
//                    echo PHP_EOL;
//                    echo $resE;
//                    echo PHP_EOL;
//                    //var_dump($resRange);
//                    echo PHP_EOL;
//                    echo '----------------------';
//                    var_dump($resRange);
//                    var_dump($date);
//                    var_dump($weekDay);
//                    var_dump($v['name']);
//                    echo '----------------------';
//                    echo PHP_EOL;
                    $ary_2[$v['name']]['total'][] = $resRange;
                    $ary_2[$v['name']]['days'][] = $date;


//                    echo $v['created_at'];
//                    echo $v['name'];
//                    echo PHP_EOL;
//                    //echo $dateSub;
//                    echo $v2['created_at'];
//                    echo $v2['name'];
//                    echo PHP_EOL;
//                    echo $resS;
//                    echo PHP_EOL;
//                    echo $resE;
//                    echo PHP_EOL;
//                    echo '----------------------';
//                    echo PHP_EOL;
                }


            }
        }
    }


}
foreach ($ary_2 as $k => &$v) {
    $tempTotal = 0;
    echo "name:$k";
    foreach ($v['total'] as $k2 => $v2) {
        if (empty($v['t2'])) $v['t2'] = 0;
        $time = explode(":", $v2);
        foreach ($time as $k3=>&$v3){
            $v3= (int)$v3;
        }

        $tempTotal += $time[0] * 60 * 60;
        $tempTotal += $time[1] * 60;
        $tempTotal += $time[2];

        echo PHP_EOL;
        $newK=$k2+1;
        $week=getWeekDay($v['days'][$k2]);
        echo "day{$newK}:{$v['days'][$k2]}({$week}) {$v2}";
        echo PHP_EOL;
    }
//    var_dump($tempTotal);
    $hours = intval($tempTotal / (60*60));
    $minutes = $tempTotal % 60;
    $v['t2'] = "$hours : $minutes";
    echo "total: {$v['t2']}";
    echo PHP_EOL;

    echo '----------------------';
    echo PHP_EOL;

}
//var_dump($ary_2);





