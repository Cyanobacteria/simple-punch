<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftType extends Model
{
    //指定table
    protected $table = 'shift_types';
    //可多筆新增的欄位
    protected $fillable = [
        'name'
    ];
}
