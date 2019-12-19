<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    //
    protected $table = 'statuses';
    //可多筆新增的欄位
    protected $fillable = [
        'name'
    ];
}
