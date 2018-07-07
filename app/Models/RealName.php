<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealName extends Model
{
    protected $table = 'real_name';

    public $timestamps = true;
    //定义时间字段
    const CREATED_AT = 'created_at';//添加时间
    const UPDATED_AT = 'updated_at';//修改时间
    //定义新增字段
    protected $fillable = ['user_id','name','card','front_card','bank_card','province','city','county','gender','birthday','zodiac','age','constellation'];
}
