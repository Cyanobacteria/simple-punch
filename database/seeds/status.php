<?php

use Illuminate\Database\Seeder;

class status extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(
            [[
                'id' => 1,
                'name' => "可用",
            ],
                [
                    'id' => 2,
                    'name' => "不可用"
                ]]
        );
    }
}
