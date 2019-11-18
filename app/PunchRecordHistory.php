<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PunchRecordHistory extends Model
{
    //指定table
    protected $table = 'punch_record_history';
    //可多筆新增的欄位
    protected $fillable = [
        'punch_record_id', 'raw_data', 'updated_at'
    ];
    public $timestamps = false;
}
