<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PunchResult extends Model
{
    //指定table
    protected $table = 'punch_results';
    //可多筆新增的欄位
    protected $fillable = [
        'name'
    ];
}
