<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_time extends Model
{
    const CREATED_AT      = 'created_at';
    const UPDATED_AT      = 'updated_at';
    protected $connection = 'mysql';
    protected $table      = 'user_time';
    protected $primaryKey = "id";


}
