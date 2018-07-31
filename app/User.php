<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ui_user';
    //开启时间戳自动写入
    public $timestamps = true;
    //调整时间戳字段
    const CREATED_AT = 'user_addtime';
    const UPDATED_AT = 'user_updatetime';
    //添加数据白名单
    protected $fillable = ['user_name','user_account','user_nickname','user_mobile','user_email','user_type','user_logtime','user_ip',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_pwd', 'user_token',
    ];
}
