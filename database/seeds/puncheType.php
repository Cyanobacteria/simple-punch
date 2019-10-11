<?php

use Illuminate\Database\Seeder;

class puncheType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('punch_types')->insert([
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
                    'name' => "請假"
                ]
            ]
        );
    }
}
