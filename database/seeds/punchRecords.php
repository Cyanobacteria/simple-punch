<?php

use Illuminate\Database\Seeder;

class punchRecords extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = 12345678;
        //一個管理者 兩個工作者
        DB::table('punch_records')->insert(
            [
                //admin
                //9-月正常上下班
                [
                    'id' => 1,
                    'user_id' => 1,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 1,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-09-01 09:00:00',
                    'updated_at' => '2019-09-01 09:00:00',
                ],
                [
                    'id' => 2,
                    'user_id' => 1,
                    'shift_type_id' => 1,
                    'punch_type_id' => 2,
                    'punch_user_id' => 1,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-09-01 18:00:00',
                    'updated_at' => '2019-09-01 18:00:00',
                ],
                //10月遲到早退
                [
                    'id' => 3,
                    'user_id' => 1,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 1,
                    'punch_result_id' => 1,
                    'status' => 1,
                    'remark' => '遲到',
                    'created_at' => '2019-10-01 09:01:00',
                    'updated_at' => '2019-10-01 09:01:00',
                ],
                [
                    'id' => 4,
                    'user_id' => 1,
                    'shift_type_id' => 1,
                    'punch_type_id' => 2,
                    'punch_user_id' => 1,
                    'punch_result_id' => 2,
                    'status' => 1,
                    'remark' => '早退',
                    'created_at' => '2019-10-01 13:00:00',
                    'updated_at' => '2019-10-01 13:00:00',
                ],
                //11月 請假
                [
                    'id' => 5,
                    'user_id' => 1,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 1,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '請假',
                    'created_at' => '2019-11-01 09:01:00',
                    'updated_at' => '2019-11-01 09:01:00',
                ],
                //user
                //user1
                //9-月正常上下班
                [
                    'id' => 6,
                    'user_id' => 2,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 2,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-09-01 09:00:00',
                    'updated_at' => '2019-09-01 09:00:00',
                ],
                [
                    'id' => 7,
                    'user_id' => 2,
                    'shift_type_id' => 1,
                    'punch_type_id' => 2,
                    'punch_user_id' => 2,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-09-01 18:00:00',
                    'updated_at' => '2019-09-01 18:00:00',
                ],
                //10月遲到早退
                [
                    'id' => 8,
                    'user_id' => 2,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 2,
                    'punch_result_id' => 1,
                    'status' => 1,
                    'remark' => '遲到',
                    'created_at' => '2019-10-01 09:01:00',
                    'updated_at' => '2019-10-01 09:01:00',
                ],
                [
                    'id' => 9,
                    'user_id' => 2,
                    'shift_type_id' => 1,
                    'punch_type_id' => 2,
                    'punch_user_id' => 2,
                    'punch_result_id' => 2,
                    'status' => 1,
                    'remark' => '早退',
                    'created_at' => '2019-10-01 13:00:00',
                    'updated_at' => '2019-10-01 13:00:00',
                ],
                //11月 請假
                [
                    'id' => 10,
                    'user_id' => 2,
                    'shift_type_id' => 1,
                    'punch_type_id' => 3,
                    'punch_user_id' => 1,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '請假',
                    'created_at' => '2019-11-01 09:01:00',
                    'updated_at' => '2019-11-01 09:01:00',
                ],
                //user2
                //9-月正常上下班
                [
                    'id' => 11,
                    'user_id' => 3,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 3,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-09-01 09:00:00',
                    'updated_at' => '2019-09-01 09:00:00',
                ],
                [
                    'id' => 12,
                    'user_id' => 3,
                    'shift_type_id' => 1,
                    'punch_type_id' => 2,
                    'punch_user_id' => 3,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-09-01 18:00:00',
                    'updated_at' => '2019-09-01 18:00:00',
                ],
                //10月遲到早退
                [
                    'id' => 13,
                    'user_id' => 3,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 3,
                    'punch_result_id' => 1,
                    'status' => 1,
                    'remark' => '遲到',
                    'created_at' => '2019-10-01 09:01:00',
                    'updated_at' => '2019-10-01 09:01:00',
                ],
                [
                    'id' => 14,
                    'user_id' => 3,
                    'shift_type_id' => 1,
                    'punch_type_id' => 2,
                    'punch_user_id' => 3,
                    'punch_result_id' => 2,
                    'status' => 1,
                    'remark' => '早退',
                    'created_at' => '2019-10-01 13:00:00',
                    'updated_at' => '2019-10-01 13:00:00',
                ],
                //11月 異常-忘記打卡
                [ //上班忘記打
                    'id' => 15,
                    'user_id' => 3,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 3,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-11-01 09:00:00',
                    'updated_at' => '2019-11-01 09:00:00',
                ], [ //上班忘記打
                    'id' => 16,
                    'user_id' => 3,
                    'shift_type_id' => 1,
                    'punch_type_id' => 2,
                    'punch_user_id' => 3,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-11-02 19:01:00',
                    'updated_at' => '2019-11-02 19:01:00',
                ],
                //------新增 admin 1 第二天資料
                [
                    'id' => 17,
                    'user_id' => 1,
                    'shift_type_id' => 1,
                    'punch_type_id' => 1,
                    'punch_user_id' => 1,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-09-02 08:30:00',
                    'updated_at' => '2019-09-02 08:30:00',
                ],
                [
                    'id' => 18,
                    'user_id' => 1,
                    'shift_type_id' => 1,
                    'punch_type_id' => 2,
                    'punch_user_id' => 1,
                    'punch_result_id' => 3,
                    'status' => 1,
                    'remark' => '',
                    'created_at' => '2019-09-02 19:01:00',
                    'updated_at' => '2019-09-02 19:01:00',
                ],


            ]
        );
    }
}
