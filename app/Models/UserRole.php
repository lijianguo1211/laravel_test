<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';
    //主键
    //protected $primaryKey= 'id';
    //开启时间戳自动写入
    public $timestamps = true;
    //定义时间字段
    const CREATED_AT = 'create_time';//添加时间
    const UPDATED_AT = 'update_time';//修改时间
    //定义新增字段
    protected $fillable = ['role_id','user_id'];
}
