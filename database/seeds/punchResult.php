<?php

use Illuminate\Database\Seeder;

class punchResult extends Seeder
{
    /**
     * Run the database seeds.
     * Schema::create($this->tableName, function (Blueprint $table) {
     * $table->engine = 'InnoDB';
     * $table->increments('id');
     * $table->string('name', 30);
     * $table->time('start');
     * $table->time('end');
     * $table->integer('status');
     * $table->timestamp('created_at');
     * });
     * @return void
     */
    public function run()
    {
        DB::table('punch_results')->insert(
            [
                [
                    'id' => 1,
                    'name' => "遲到",
                ],
                [
                    'id' => 2,
                    'name' => "早退"
                ]
                ,
                [
                    'id' => 3,
                    'name' => "正常"
                ]

            ]
        );
    }
}
