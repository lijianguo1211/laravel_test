<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    //开启时间戳自动写入
    public $timestamps = true;
    //调整时间戳字段
    const CREATED_AT = '';
    const UPDATED_AT = '';
    //添加数据白名单
    protected $fillable = [];
}
