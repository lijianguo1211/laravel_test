<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //角色添加模型

    //命名表
    protected $table = 'role';
    //主键
    protected $primaryKey= 'role_id';
    //开启时间戳自动写入
    public $timestamps = true;
    //定义时间字段
    const CREATED_AT = 'role_addtime';//添加时间
    const UPDATED_AT = 'role_updatetime';//修改时间
    //定义新增字段
    protected $fillable = ['role_name','role_status'];
}
