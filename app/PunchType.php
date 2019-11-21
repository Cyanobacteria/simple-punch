<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PunchType extends Model
{
    //指定table
    protected $table = 'punch_types';
    //可多筆新增的欄位
    protected $fillable = [
        'name'
    ];
}
