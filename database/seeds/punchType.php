<?php

use Illuminate\Database\Seeder;

class punchType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('punch_types')->insert(
            [
                [
                    'id' => 1,
                    'name' => "上班",
                ],
                [
                    'id' => 2,
                    'name' => "下班"
                ],
                [
                    'id' => 3,
                    'name' => "請假 | 病假"
                ],  [
                    'id' => 4,
                    'name' => "請假 | 事假"
                ],  [
                    'id' => 5,
                    'name' => "請假 | 婚假"
                ],  [
                    'id' => 6,
                    'name' => "請假 | 喪假"
                ],  [
                    'id' => 7,
                    'name' => "請假 | 公傷病假"
                ],  [
                    'id' => 8,
                    'name' => "請假 | 特別休假"
                ],  [
                    'id' => 9,
                    'name' => "請假 | 分娩假"
                ],  [
                    'id' => 10,
                    'name' => "請假 | 產檢假"
                ],  [
                    'id' => 11,
                    'name' => "請假 | 流產假"
                ],  [
                    'id' => 12,
                    'name' => "請假 | 陪產假"
                ],  [
                    'id' => 13,
                    'name' => "請假 | 分娩假"
                ],  [
                    'id' => 14,
                    'name' => "請假 | 產前假"
                ],


















            ]
        );
    }
}
