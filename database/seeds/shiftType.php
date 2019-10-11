<?php

use Illuminate\Database\Seeder;

class shiftType extends Seeder
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
        DB::table('shift_types')->insert(
            [[
                'id' => 1,
                'name' => "早班",
                'start' => '09:00:00',
                'end' => '12:00:00',
                'status' => 1,
                'created_at'=>now()
            ],
            [
                'id' => 2,
                'name' => "午班",
                'start' => '13:30:00',
                'end' => '18:00:00',
                'status' => 1,
                'created_at'=>now()

            ], [
                'id' => 3,
                'name' => "全班",
                'start' => '09:00:00',
                'end' => '18:00:00',
                'status' => 1,
                'created_at'=>now()

            ]]
        );
    }
}
