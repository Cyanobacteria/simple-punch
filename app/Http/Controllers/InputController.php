<?php

namespace App\Http\Controllers;

use App\PunchRecord;
use App\User;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function save($user)
    {
        try {
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

    public function input()
    {

        $user_punch = array(
            array('name' => '羅名宏', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-01 8:55:02', 'updated_at' => '2019-10-01 10:33:02'),
            array('name' => '徐子洋', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-01 13:04:56', 'updated_at' => '2019-10-01 13:04:56'),
            array('name' => '羅名宏', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-01 18:11:59', 'updated_at' => '2019-10-01 18:11:59'),
            array('name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-01 18:35:27', 'updated_at' => '2019-10-01 18:35:27'),
            array('name' => '徐子洋', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-02 09:01:48', 'updated_at' => '2019-10-02 09:01:48'),
            array('name' => '蔡名皓', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-02 09:08:50', 'updated_at' => '2019-10-02 09:08:50'),
            array('name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-02 18:00:35', 'updated_at' => '2019-10-02 18:00:35'),
            array('name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-02 19:56:42', 'updated_at' => '2019-10-02 19:56:42'),
            array('name' => '羅名宏', 'status' => '上班', 'detail' => '正常', 'created_at' => '2019-10-03 09:02:28', 'updated_at' => '2019-10-03 09:02:28'),
            array('name' => '徐子洋', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-03 14:06:46', 'updated_at' => '2019-10-03 14:06:46'),
            array('name' => '蔡名皓', 'status' => '上班', 'detail' => '未準時', 'created_at' => '2019-10-03 15:38:12', 'updated_at' => '2019-10-03 15:38:12'),
            array('name' => '徐子洋', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-03 18:05:07', 'updated_at' => '2019-10-03 18:05:07'),
            array('name' => '蔡名皓', 'status' => '下班', 'detail' => '正常', 'created_at' => '2019-10-03 18:11:42', 'updated_at' => '2019-10-03 18:11:42'),
        );


        for ($i = 0; $i <= 20; $i++) {
            $punch = New PunchRecord();
            if ($user_punch[i]['name'] == '徐子洋') {
                $punch->user_id = '4';
            } elseif ($user_punch[i]['name'] == '羅名宏') {
                $punch->user_id = '5';
            } else {
                $punch->user_id = '6';
            }

            $user_punch[i]['state'] == '1'


            $punch -> save();
        }

        for ($i = 0; $i <= 20; $i++) {
            $punch = New PunchRecord();
            if ($user_punch[0]['status'] == '上班') {
                $punch->shift_type_id = '1';
            } elseif ($user_punch[0]['status'] == '下班') {
                $punch->shift_type_id = '2';
            } elseif ($user_punch[0]['status'] == '請假 | 病假') {
                $punch->shift_type_id = '3';
            } elseif ($user_punch[0]['status'] == '請假 | 事假') {
                $punch->shift_type_id = '4';
            } elseif ($user_punch[0]['status'] == '請假 | 婚假') {
                $punch->shift_type_id = '5';
            } elseif ($user_punch[0]['status'] == '請假 | 喪假') {
                $punch->shift_type_id = '6';
            } elseif ($user_punch[0]['status'] == '請假 | 公傷病假') {
                $punch->shift_type_id = '7';
            } elseif ($user_punch[0]['status'] == '請假 | 特別休假') {
                $punch->shift_type_id = '8';
            } elseif ($user_punch[0]['status'] == '請假 | 分娩假') {
                $punch->shift_type_id = '9';
            } elseif ($user_punch[0]['status'] == '請假 | 產檢假') {
                $punch->shift_type_id = '10';
            } elseif ($user_punch[0]['status'] == '請假 | 流產假') {
                $punch->shift_type_id = '11';
            } elseif ($user_punch[0]['status'] == '請假 | 陪產假') {
                $punch->shift_type_id = '12';
            } else {
                $punch->shift_type_id = '13';
            }
            dd($punch->shift_type_id);
        }



        return view('ok123');




    }



}
