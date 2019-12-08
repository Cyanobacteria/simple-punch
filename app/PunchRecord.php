<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PunchRecord extends Model
{
    const CREATED_AT      = 'created_at';
//    const UPDATED_AT      = 'updated_at';
    protected $connection = 'mysql';
    protected $table      = 'punch_records';
    protected $primaryKey = "id";
    public $timestamps = false;

}
