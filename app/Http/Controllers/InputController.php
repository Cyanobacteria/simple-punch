<?php

namespace App\Http\Controllers;

use App\PunchRecord;
use Auth;
use App\User;
use DB;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function save($user)
    {
        try {
            $user = new User();
            $punch = new PunchRecord();
            $punch->user_id = $user->name;
            $punch->shift_type_id = $user->shift_type;
            $punch->punch_type_id = $user->punch_type;
            $punch->punch_user_id = $user->punch_user;
            $punch->punch_result_id = $user->punch_result;
            $punch->status = $user->status;
            $punch->remark = $user->detail;
            $punch->created_at = now();
            $punch->updated_at = $user->updated_at;


            $insertId = $punch->save();
        } catch (\Exception $e) {
            return $e;
        }
        return $punch;



    }


    public function input(Request $request)
    {
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

     /*   $user_punch = array(
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
        );*/

      /*  $user_data = array(
            array('test', 'user@test.com', NULL, '$2y$10$veE91X2Y1zNcY4fBrHbziudnKLJPRKTLg8eJVwMU1WwV2b2/ZtHuK', 'wV5nI6SPBWJpbsCUPeTxKx0fCJyakCSiNlQVoFJk9RjgU4TnVf0XvyE8xWdO', NULL, '2019-06-28 09:23:56', '2019-06-28 09:23:56'),
            array('test', 'test@gmail.com', NULL, '$2y$10$MDK7KbrIDolzGpiGYb2m6uD3m7R/QFqvWa/0hd6d5ECdjfjuIp1My', NULL, NULL, '2019-06-28 17:30:05', '2019-06-28 17:30:05'),
            array('徐子洋', '44inkx@gmail.com', NULL, '$2y$10$lN20LHY2UKBfe7siB2uXw.E41/MH9.EBZCc4x9k.lGSzL5b3EIRUC', NULL, NULL, '2019-07-01 09:46:17', '2019-07-01 09:46:17'),
            array('陳彥均', 'ader580206ader52@gmail.com', NULL, '$2y$10$p38g6UO6m7r7.KAXlUmdR.F9lACmgpeVaoz0JLNibTQAjjcBRoC.C', 'PZ7cKQ6FxKJYKXtBrzjGTflJhIpbhkrs7BBFhBVCWjynKTOKGmEkWPyO4cdN', NULL, '2019-07-01 09:46:20', '2019-07-01 09:46:20'),
            array('曾柏訓', '40511176@gcloud.csu.edu.tw', NULL, '$2y$10$QtmqGNcPBpZJRhaWn3Mk7uXuX7mU5hknN3VuMMGYpTguistwgAkgS', 'aNXhpZKDaCyoZK4gkhXtNWc5YRId4kTH97v5MaCbESUmAo5jMgFmhhNlv11Z', NULL, '2019-07-01 09:46:35', '2019-07-01 09:46:35'),
            array('蔡名皓', '40511175@gcloud.csu.edu.tw', NULL, '$2y$10$bnHnUxdeSAmEQQ1QrwQsb.pSuCORLUPy4Xv7iYoUpaizRipyyhoo6', NULL, NULL, '2019-07-01 09:46:45', '2019-07-01 09:46:45'),
            array('蕭竣鴻', '40411111@gcloud.csu.edu.tw', NULL, '$2y$10$nTK7J7eX3kULbPXZ5eAnhOMDxmKDIWgAH0.5GF26qRnhgeyDJyinK', NULL, NULL, '2019-07-01 09:47:17', '2019-07-01 09:47:17'),
            array('羅名宏', 'romoesy@gmail.com', NULL, '$2y$10$8arCTVSce3qlZok1O.9txOaguk7CM.FGmKczL/MDR4E6KLhL06FSK', NULL, NULL, '2019-07-01 09:47:23', '2019-07-01 09:47:23'),
            array('薛瑞瑋', '40511173@gcloud.csu.edu.tw', NULL, '$2y$10$wBahu1vR5hdct2BNBYTECe9mOXkDSYyaHVQq64rfyJLACNeegc39y', NULL, NULL, '2019-07-01 09:47:46', '2019-07-01 09:47:46'),
            array('薛詩絹', '40511174@gcloud.csu.edu.tw', NULL, '$2y$10$XV.BQn3u4FM/xK9XaCUvKOM373ebGe0kt/ysvExatEuXdB6hyNTTq', 'IrFbbuQqPeqUn82L8Ba0Yyb42bzbAd3GpdkKU3u3ZTBNueNEm1rkbafWd5E7', NULL, '2019-07-01 09:48:16', '2019-07-01 09:48:16'),
            array('吳建宏', 'csu40511153@gmail.com', NULL, '$2y$10$QZrq5bwRqD/0jVD8yWUnWO2if0a3M/ZcDO3zklDkiMTsaIAyl5.Ie', 'k6b3CgbzDwlgc7tRiTxh1SWM8deiMajRQEY8TcVIhBUjFWazj17PYh6vfCWC', NULL, '2019-07-01 09:50:03', '2019-07-01 09:50:03'),
            array('chloe@funcity18.com', 'chloe@funcity18.com', NULL, '$2y$10$gyboQ7mUb9VRSleGdWReE./EglHXOM6dwJV6OEklMbGTOdefZuPOq', NULL, 1, '2019-07-02 16:07:59', '2019-07-02 16:07:59'),
            array('蔡名皓', 'howard995511775533@gmail.com', NULL, '$2y$10$V/dnYftMToMLWmWmBWBw5eYs/2X5kGKBG8UBwNRDJ7iMDBB0RQMJe', NULL, NULL, '2019-10-01 10:35:01', '2019-10-01 10:35:01'),
            array('倪坤哲', 'vodomelkor@gmail.com', NULL, '$2y$10$BOvTNvkPlfC8dwFExyL0N.SZ3GIpMxiX.iJ3O/FZwfdMCC4LZqbOO', NULL, NULL, '2019-10-10 12:27:09', '2019-10-10 12:27:09'),
            array('water', 'water@gmail.com', NULL, '$2y$10$HQbi3FTcpP6wQy9ycZaVxO53MrWa26qDQuPVd33fKnichDX.qsTO2', NULL, NULL, '2019-11-15 14:48:26', '2019-11-15 14:48:26'),

        );*/

        $user_time =array(
          /*  array('羅名宏', '上班', '未準時', '2019-10-01 10:33:02', '2019-10-01 10:33:02'),
            array('徐子洋', '上班', '未準時', '2019-10-01 13:04:56', '2019-10-01 13:04:56'),
            array('羅名宏', '下班', '正常', '2019-10-01 18:11:59', '2019-10-01 18:11:59'),
            array('徐子洋', '下班', '正常', '2019-10-01 18:35:27', '2019-10-01 18:35:27'),
            array('徐子洋', '上班', '正常', '2019-10-02 09:01:48', '2019-10-02 09:01:48'),
            array('蔡名皓', '上班', '正常', '2019-10-02 09:08:50', '2019-10-02 09:08:50'),
            array('徐子洋', '下班', '正常', '2019-10-02 18:00:35', '2019-10-02 18:00:35'),
            array('蔡名皓', '下班', '正常', '2019-10-02 19:56:42', '2019-10-02 19:56:42'),
            array('羅名宏', '上班', '正常', '2019-10-03 09:02:28', '2019-10-03 09:02:28'),
            array('徐子洋', '上班', '未準時', '2019-10-03 14:06:46', '2019-10-03 14:06:46'),
            array('蔡名皓', '上班', '未準時', '2019-10-03 15:38:12', '2019-10-03 15:38:12'),
            array('徐子洋', '下班', '正常', '2019-10-03 18:05:07', '2019-10-03 18:05:07'),
            array('蔡名皓', '下班', '正常', '2019-10-03 18:11:42', '2019-10-03 18:11:42'),
            array('羅名宏', '下班', '正常', '2019-10-03 18:13:52', '2019-10-03 18:13:52'),
            array('羅名宏', '上班', '未準時', '2019-10-04 13:33:20', '2019-10-04 13:33:20'),
            array('羅名宏', '下班', '正常', '2019-10-04 18:04:53', '2019-10-04 18:04:53'),
            array('羅名宏', '上班', '正常', '2019-10-08 08:49:07', '2019-10-08 08:49:07'),
            array('徐子洋', '上班', '未準時', '2019-10-08 13:00:14', '2019-10-08 13:00:14'),
            array('徐子洋', '下班', '正常', '2019-10-08 18:06:59', '2019-10-08 18:06:59'),
            array('羅名宏', '下班', '正常', '2019-10-08 18:10:52', '2019-10-08 18:10:52'),
            array('徐子洋', '上班', '正常', '2019-10-09 09:04:00', '2019-10-09 09:04:00'),
            array('蔡名皓', '上班', '正常', '2019-10-09 09:20:49', '2019-10-09 09:20:49'),
            array('徐子洋', '下班', '正常', '2019-10-09 18:00:40', '2019-10-09 18:00:40'),
            array('蔡名皓', '下班', '正常', '2019-10-09 18:03:18', '2019-10-09 18:03:18'),
            array('倪坤哲', '上班', '未準時', '2019-10-10 15:39:15', '2019-10-10 15:39:15'),
            array('羅名宏', '上班', '正常', '2019-10-15 08:50:57', '2019-10-15 08:50:57'),
            array('羅名宏', '下班', '正常', '2019-10-15 18:02:54', '2019-10-15 18:02:54'),
            array('徐子洋', '上班', '正常', '2019-10-16 09:02:22', '2019-10-16 09:02:22'),
            array('蔡名皓', '上班', '正常', '2019-10-16 09:24:36', '2019-10-16 09:24:36'),
            array('徐子洋', '下班', '正常', '2019-10-16 18:04:35', '2019-10-16 18:04:35'),
            array('蔡名皓', '下班', '正常', '2019-10-16 18:10:55', '2019-10-16 18:10:55'),
            array('羅名宏', '上班', '正常', '2019-10-17 08:48:23', '2019-10-17 08:48:23'),
            array('蔡名皓', '上班', '未準時', '2019-10-17 15:36:00', '2019-10-17 15:36:00'),
            array('羅名宏', '下班', '正常', '2019-10-17 18:09:31', '2019-10-17 18:09:31'),
            array('蔡名皓', '下班', '正常', '2019-10-17 18:27:29', '2019-10-17 18:27:29'),
            array('羅名宏', '上班', '未準時', '2019-10-18 12:51:04', '2019-10-18 13:51:04'),
            array('羅名宏', '下班', '正常', '2019-10-18 18:02:36', '2019-10-18 18:02:36'),
            array('羅名宏', '上班', '正常', '2019-10-22 09:10:45', '2019-10-22 09:10:45'),
            array('羅名宏', '下班', '正常', '2019-10-22 18:07:48', '2019-10-22 18:07:48'),
            array('徐子洋', '上班', '正常', '2019-10-23 09:03:19', '2019-10-23 09:03:19'),
            array('蔡名皓', '上班', '未準時', '2019-10-23 09:37:21', '2019-10-23 09:37:21'),
            array('徐子洋', '下班', '正常', '2019-10-23 18:01:45', '2019-10-23 18:01:45'),
            array('蔡名皓', '下班', '正常', '2019-10-23 18:03:55', '2019-10-23 18:03:55'),
            array('羅名宏', '上班', '正常', '2019-10-24 08:55:02', '2019-10-24 08:55:02'),
            array('蔡名皓', '上班', '未準時', '2019-10-24 15:46:01', '2019-10-24 15:46:01'),
            array('羅名宏', '下班', '正常', '2019-10-24 18:12:53', '2019-10-24 18:12:53'),
            array('蔡名皓', '下班', '正常', '2019-10-24 18:27:49', '2019-10-24 18:27:49'),
            array('羅名宏', '上班', '未準時', '2019-10-25 13:25:56', '2019-10-25 13:25:56'),
            array('羅名宏', '下班', '正常', '2019-10-25 18:02:40', '2019-10-25 18:02:40'),
            array('羅名宏', '上班', '正常', '2019-10-28 08:48:23', '2019-10-28 08:48:23'),
            array('羅名宏', '下班', '異常', '2019-10-28 11:59:51', '2019-10-28 12:01:51'),
            array('羅名宏', '上班', '正常', '2019-10-29 08:53:03', '2019-10-29 08:53:03'),
            array('羅名宏', '下班', '正常', '2019-10-29 18:06:37', '2019-10-29 18:06:37'),
            array('蔡名皓', '上班', '未準時', '2019-10-30 13:50:13', '2019-10-30 13:50:13'),
            array('徐子洋', '上班', '未準時', '2019-10-30 13:50:31', '2019-10-30 13:50:31'),
            array('徐子洋', '下班', '正常', '2019-10-30 18:03:30', '2019-10-30 18:03:30'),
            array('蔡名皓', '下班', '正常', '2019-10-30 18:04:28', '2019-10-30 18:04:28'),
            array('羅名宏', '上班', '正常', '2019-10-31 08:50:50', '2019-10-31 08:50:50'),
            array('蔡名皓', '上班', '未準時', '2019-10-31 14:28:59', '2019-10-31 14:28:59'),
            array('羅名宏', '下班', '正常', '2019-10-31 18:16:06', '2019-10-31 18:16:06'),
            array('蔡名皓', '下班', '正常', '2019-10-31 18:20:01', '2019-10-31 18:20:01'),
            array('蔡名皓', '上班', '未準時', '2019-11-01 14:35:08', '2019-11-01 14:35:08'),
            array('羅名宏', '上班', '未準時', '2019-11-01 14:51:12', '2019-11-01 14:51:12'),
            array('蔡名皓', '下班', '正常', '2019-11-01 18:22:04', '2019-11-01 18:22:04'),
            array('羅名宏', '下班', '正常', '2019-11-01 18:22:33', '2019-11-01 18:22:33'),
            array('羅名宏', '上班', '正常', '2019-11-05 08:42:56', '2019-11-05 08:42:56'),
            array('羅名宏', '下班', '正常', '2019-11-05 18:53:35', '2019-11-05 18:53:35'),
            array('徐子洋', '上班', '正常', '2019-11-06 08:58:14', '2019-11-06 08:58:14'),
            array('蔡名皓', '上班', '正常', '2019-11-06 09:11:00', '2019-11-06 09:11:00'),
            array('徐子洋', '下班', '正常', '2019-11-06 18:27:40', '2019-11-06 18:27:40'),
            array('蔡名皓', '下班', '正常', '2019-11-06 18:28:37', '2019-11-06 18:28:37'),
            array('蔡名皓', '上班', '未準時', '2019-11-07 15:31:45', '2019-11-07 15:31:45'),
            array('蔡名皓', '下班', '正常', '2019-11-07 19:04:39', '2019-11-07 19:04:39'),
            array('羅名宏', '下班', '正常', '2019-11-07 19:04:41', '2019-11-07 19:04:41'),
            array('蔡名皓', '上班', '未準時', '2019-11-08 10:37:03', '2019-11-08 10:37:03'),
            array('徐子洋', '上班', '未準時', '2019-11-08 11:47:15', '2019-11-08 11:47:15'),
            array('羅名宏', '上班', '未準時', '2019-11-08 12:57:27', '2019-11-08 12:57:27'),
            array('羅名宏', '下班', '正常', '2019-11-08 18:38:39', '2019-11-08 18:38:39'),
            array('徐子洋', '下班', '正常', '2019-11-08 19:03:22', '2019-11-08 19:03:22'),
            array('蔡名皓', '下班', '正常', '2019-11-08 19:16:39', '2019-11-08 19:16:39'),
            array('羅名宏', '上班', '正常', '2019-11-12 08:49:51', '2019-11-12 08:49:51'),
            array('羅名宏', '下班', '正常', '2019-11-12 18:32:09', '2019-11-12 18:32:09'),
            array('徐子洋', '上班', '正常', '2019-11-13 09:02:09', '2019-11-13 09:02:09'),
            array('蔡名皓', '上班', '正常', '2019-11-13 09:09:48', '2019-11-13 09:09:48'),
            array('羅名宏', '上班', '未準時', '2019-11-14 13:25:30', '2019-11-14 13:25:30'),
            array('羅名宏', '下班', '正常', '2019-11-14 19:15:39', '2019-11-14 19:15:39'),
            array('蔡名皓', '下班', '正常', '2019-11-14 19:16:08', '2019-11-14 19:16:08'),
            array('蔡名皓', '上班', '未準時', '2019-11-14 19:24:58', '2019-11-14 19:24:58'),
            array('羅名宏', '上班', '未準時', '2019-11-15 12:50:17', '2019-11-15 12:50:17'),
            array('water', '上班', '未準時', '2019-11-15 14:48:31', '2019-11-15 14:48:31'),
            array('water', '下班', '異常', '2019-11-15 14:48:41', '2019-11-15 14:48:41'),
            array('羅名宏', '下班', '正常', '2019-11-15 19:25:47', '2019-11-15 19:25:47'),
            array('羅名宏', '上班', '正常', '2019-11-18 08:34:53', '2019-11-18 08:34:53'),
            array('羅名宏', '下班', '異常', '2019-11-18 12:01:34', '2019-11-18 12:01:34'),
            array('羅名宏', '上班', '正常', '2019-11-19 08:38:49', '2019-11-19 08:38:49'),
            array('羅名宏', '下班', '正常', '2019-11-19 18:19:40', '2019-11-19 18:19:40'),
            array('徐子洋', '上班', '正常', '2019-11-20 08:57:13', '2019-11-20 08:57:13'),
            array('蔡名皓', '上班', '正常', '2019-11-20 08:58:23', '2019-11-20 08:58:23'),
            array('徐子洋', '下班', '異常', '2019-11-20 17:07:29', '2019-11-20 17:07:29'),
            array('蔡名皓', '下班', '異常', '2019-11-20 17:08:01', '2019-11-20 17:08:01'),
            array('羅名宏', '上班', '正常', '2019-11-21 08:42:22', '2019-11-21 08:42:22'),
            array('蔡名皓', '上班', '未準時', '2019-11-21 15:43:29', '2019-11-21 15:43:29'),
            array('羅名宏', '下班', '正常', '2019-11-21 19:30:45', '2019-11-21 19:30:45'),
            array('蔡名皓', '下班', '正常', '2019-11-21 19:37:54', '2019-11-21 19:37:54'),
            array('羅名宏', '上班', '未準時', '2019-11-22 11:31:37', '2019-11-22 11:31:37'),
            array('羅名宏', '下班', '正常', '2019-11-22 18:31:05', '2019-11-22 18:31:05'),
            array('羅名宏', '上班', '正常', '2019-11-25 08:45:08', '2019-11-25 08:45:08'),
            array('羅名宏', '下班', '異常', '2019-11-25 12:08:52', '2019-11-25 12:08:52'),*/
        );






/*
        $user_data[0][1];
        $tempAry=[];
        $tempAry=array();
        $user = New User();

        foreach ($user_data as $k=>$v) {

            $tempAry1[] = $v[0];
            $tempAry2[] = $v[1];
            $tempAry3[] = $v[2];
            $tempAry4[] = $v[3];
            $tempAry5[] = $v[4];
            $tempAry6[] = $v[5];
            $tempAry7[] = $v[6];
            $tempAry8[] = $v[7];
        }




        $userDb = User::all();
        $usersDataname = array('name');
        $usersDataemail = array('email');
        $newUser = [];
        $dataOk = [];

        $emailUser =array();
        $nameUser = array();
        $okName = array();
        $okEmail =array();

        //新資料庫-將新資料庫裏面的名子跟信箱另外存放
        foreach ($userDb as $k =>$v) {
            array_push($usersDataname, $v->name);
            array_push($usersDataemail, $v->email);
        }
            //舊資料庫-將email跟name 用陣列分開存放
        foreach ($user_data as $k2 => $v2) {
            array_push($emailUser, $v2[1]);
            array_push($nameUser, $v2[0]);
            array_push($newUser,[$v2[0],$v2[1],$v2[3]]);
        }
*/
            //判斷舊資料庫 與新資料是否有一樣的
            /*if(count($okName)< count($nameUser)){
                $nameOk = array_diff($okName,$usersDataname);
            }elseif(count($okEmail)< count($emailUser)){
                $emailOk = array_diff($okEmail,$usersDataemail);
            }else{
                $emailOk = array_diff($okEmail,$usersDataemail);
            }



            for($i = 0 ; $i < count($newUser) ;$i++){
                if(isset($okName[1]) != null || isset($okEmail[1]) != null ) {
                 //   array_push($dataOk,[$okName[$i],$okEmail[$i]]);
                    dd('1');
                }else{
                    dd('0');

                }

            }




            /*for ($i = 0 ; $i < count($nameOk) ; $i++)
            if(in_array($nameOk[$i],$newUser)){
                dd('1');
            }else{
                dd($nameOk[0]);
            }*/

            //if($usersData)
      /*  foreach($usersData as $v2) {
            dd($v2[0]);
        }*/

    /*    foreach ($usersData as $k2 => $v2) {
            foreach ($user_data as $k3 => $v3) {
                if ($v2[$k2] != $v3[$k3] and $v2[$k2] != $v3[$k]) {
                    array_push($newUser,[$v3[0],$v3[1],$v3[3]]);
                }
            }
        }*/



         foreach ($user_time as $k => $v) {
             $punch = New PunchRecord();
             if ($v[0] == '徐子洋') {
                 $punch->user_id = '3';
                 $punch->punch_user_id = '3';
             } elseif ($v[0] == '羅名宏') {
                 $punch->user_id = '8';
                 $punch->punch_user_id = '8';
             } elseif ($v[0] == '蔡名皓') {
                 $punch->user_id = '13';
                 $punch->punch_user_id = '13';
             } else{
                 $punch->user_id = '15';
                 $punch->punch_user_id = '15';
             }
             $punch->status = '1';
             //傳送打卡事故類型
             if ($v[1] == '上班') {
                 $punch->punch_type_id = '1';
             } elseif ($v[1] == '下班') {
                 $punch->punch_type_id = '2';
             } elseif ($v[1] == '請假 | 病假') {
                 $punch->punch_type_id = '3';
             } elseif ($v[1] == '請假 | 事假') {
                 $punch->punch_type_id = '4';
             } elseif ($v[1] == '請假 | 婚假') {
                 $punch->punch_type_id = '5';
             } elseif ($v[1] == '請假 | 喪假') {
                 $punch->punch_type_id = '6';
             } elseif ($v[1] == '請假 | 公傷病假') {
                 $punch->punch_type_id = '7';
             } elseif ($v[1] == '請假 | 特別休假') {
                 $punch->punch_type_id = '8';
             } elseif ($v[1] == '請假 | 分娩假') {
                 $punch->punch_type_id = '9';
             } elseif ($v[1] == '請假 | 產檢假') {
                 $punch->punch_type_id = '10';
             } elseif ($v[1] == '請假 | 流產假') {
                 $punch->punch_type_id = '11';
             } elseif ($v[1] == '請假 | 陪產假') {
                 $punch->punch_type_id = '12';
             } else {
                 $punch->punch_type_id = '14';
             }

             $ary_1 = [   //0 = 早班  1 = 下午班  2 = 全班   3 = 當週未排定上班
                 '羅名宏' => [
                     1 => 0,
                     2 => 2,
                     3 => 3,
                     4 => 2,
                     5 => 1,
                 ],
                 '徐子洋' => [
                     1 => 3,
                     2 => 1,
                     3 => 2,
                     4 => 1,
                     5 => 3,
                 ],
                 '蔡名皓' => [
                     1 => 3,
                     2 => 3,
                     3 => 2,
                     4 => 1,
                     5 => 3,
                 ],
                 'water' => [
                     1 => 2,
                     2 => 2,
                     3 => 2,
                     4 => 2,
                     5 => 2,
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
                 ],
                 [
                     's' => '09:00:00',  //當週未排定上班
                     'e' => '18:00:00',
                 ]
             ];
             //禮拜幾
             $weekDay = getWeekDay($v[3]);
             //上班日期
             $dateMain = getD($v[3]);
             $c = 0;
             foreach ($user_time as $k2 => $v2) {
                 $dateSub = getD($v2[3]);
                 if ($dateMain == $dateSub && $v[0] == $v2[0]) {
                     $c++;
                     if ($c > 1 && $v2[1] == '下班') {
                         //上班時間
                         $timeS = getHis($v[3]);
                         $timeSTime = explode(':', $timeS);
                         //$timeST = $timeSTime;

                         //下班時間
                         $timeE = getHis($v2[3]);
                         $timeETime = explode(':', $timeE);
                         //$timeET = $timeETime;

                         //判定班別時間
                         $timeRange = $classTypeMap[$ary_1[$v[0]][$weekDay]];
                         //設定上班時間與下班時間
                         $start = $timeRange['s'];
                         $end = $timeRange['e'];
                         $resS = '';
                         $resE = '';
                         //判定打卡上班時間，如果表定時間大於打卡"上班"時間就以表定為主
                         if (getStrToTime($start) > getStrToTime($timeS)) {
                             $resS = $start;
                         } else {
                             $resS = $timeS;
                         }
                         //設定上班時間與下班時間，判定打卡下班時間，如果表定時間小於打卡"下班"時間就以表定為主，
                         if (getStrToTime($end) > getStrToTime($timeE)) {
                             $resE = $timeE;
                         } else {
                             $resE = $end;
                         }

                    /*     $resRange = date('H:i:s', getStrToTime($resE) - getStrToTime($resS));
                         $startTime = explode(':', $start);
                         $startR = $startTime;
                         $endTime = explode(':', $end);
                         $startE = $endTime;*/

                         //判定禮拜幾什班別 0=上午 1=下午 2=全天
                         $classShify = $ary_1[$v[0]][$weekDay];

                         if ($classShify == '0') {
                             $punch->shift_type_id = '1';
                             if ($v[1] == '上班') {
                                if($start > $timeS){
                                    $punch->punch_result_id = '3';
                                    $punch->remark = " ";
                                } else {
                                    $punch->punch_result_id = '1';
                                    $punch->remark = "遲到";
                                }
                             } elseif ($v2[1] == '下班') {
                                 if($timeE > $end){
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }else{
                                     $punch->punch_result_id = '2';
                                     $punch->remark = "早退";
                                 }
                             }
                         } elseif ($classShify == '1'){
                             $punch->shift_type_id = '2';
                             if ($v[1] == '上班') {
                                 if($start > $timeS){
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 } else {
                                     $punch->punch_result_id = '1';
                                     $punch->remark = "遲到";
                                 }
                             } elseif ($v2[1] == '下班') {
                                 if($timeE > $end){
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }else{
                                     $punch->punch_result_id = '2';
                                     $punch->remark = "早退";
                                 }
                             }
                         } elseif ($classShify == '2'){
                             $punch->shift_type_id = '3';
                             if ($v[1] == '上班') {
                                 if($start > $timeS){
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 } else {
                                     $punch->punch_result_id = '1';
                                     $punch->remark = "遲到";
                                 }
                             } elseif ($v2[1] == '下班') {
                                 if($timeE > $end){
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }else{
                                     $punch->punch_result_id = '2';
                                     $punch->remark = "早退";
                                 }
                             }
                         }  elseif ($classShify == '3'){
                             $punch->shift_type_id = '3';
                             if ($v[1] == '上班') {
                                 if($start > $timeS){
                                     $punch->punch_result_id = '3';
                                     $punch->remark = "當日未於當週排定上班";
                                 } else {
                                     $punch->punch_result_id = '1';
                                     $punch->remark = "當日未於當週排定上班";  //遲到
                                 }
                             } elseif ($v2[1] == '下班') {
                                 if($timeE > $end){
                                     $punch->punch_result_id = '3';
                                     $punch->remark = "當日未於當週排定上班";
                                 }else{
                                     $punch->punch_result_id = '2';
                                     $punch->remark = "當日未於當週排定上班";  //早退
                                 }
                             }
                         }
                         //傳送打卡班別 1 =早班 2=下午班 3= 全天班 - 新資料庫
                         //$classShify 0 =早班 1=下午班 2= 全天班 - 我的定義
                       /*  if ($classShify == '0') {
                             $punch->shift_type_id = '1';
                             //判定遲到早退正常
                             if ($v[1] == '上班') {
                                 if ($timeST[0] >= $startR[0]) {
                                     $punch->punch_result_id = '1';
                                     $punch->remark = "遲到";
                                 } else {
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }
                             } elseif ($v2[1] == '下班') {
                                 if ($timeET[0] < $startE[0]) {
                                     $punch->punch_result_id = '2';
                                     $punch->remark = "早退";
                                 } else {
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }
                             }
                         } elseif ($classShify == '1') {
                             $punch->shift_type_id = '2';
                             if ($v[1] == '上班') {
                                 if ($startR[0] == $timeST[0] ) {
                                     if ( $startR[1] >= $timeST[1]){
                                         $punch->punch_result_id = '3';
                                         $punch->remark = " ";
                                     }else{
                                         $punch->punch_result_id = '1';
                                         $punch->remark = "遲到";
                                     }
                                 } elseif ($startR[0] < $timeST[0]) {
                                         $punch->punch_result_id = '1';
                                         $punch->remark = "遲到";
                                 } else {
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }
                             } elseif ($v2[1] == '下班') {
                                 if ($timeET[0] < $startE[0]) {
                                     $punch->punch_result_id = '2';
                                     $punch->remark = "早退";
                                 } else {
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }
                             }
                         } elseif ($classShify == '2') {
                             $punch->shift_type_id = '3';
                             if ($v[1] == '上班') {
                                 if ($timeST[0] >= $startR[0]) {
                                     $punch->punch_result_id = '1';
                                     $punch->remark = "遲到";
                                 } else {
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }
                             } elseif ($v2[1] == '下班') {
                                 if ($timeET[0] < $startE[0]) {
                                     $punch->punch_result_id = '2';
                                     $punch->remark = "早退";
                                 } else {
                                     $punch->punch_result_id = '3';
                                     $punch->remark = " ";
                                 }
                             }
                         }*/
                         $punch->created_at = $v[3];
                         $punch->updated_at = $v[4];
                         $punch->save();
                     }
                 }

             }





         }




    }
    public function test(){
        return view('okmoesy');
    }

}
