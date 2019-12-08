<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePunchRecordsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'punch_records';

    /**
     * Run the migrations.
     * @table punch_records
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->comment('哪一個user');
            $table->integer('shift_type_id')->comment('班別');
            $table->integer('punch_type_id')->comment('上班、下班、請假?');
            $table->integer('punch_user_id')->comment('打卡人(可能不一定讓人自己打請假卡)');
            $table->integer('punch_result_id');
            $table->integer('status');
            $table->text('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
