<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTimeTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_time';

    /**
     * Run the migrations.
     * @table user_time
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('status', 191);
            $table->string('detail', 191);
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
