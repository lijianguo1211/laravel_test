<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    //开启时间戳自动写入
    public $timestamps = true;
    //调整时间戳字段
    const CREATED_AT = 'user_addtime';
    const UPDATED_AT = 'user_updatetime';
    //添加数据白名单
    protected $fillable = ['user_name','user_account','user_nickname','user_mobile','user_email','user_pwd','user_type','user_logtime','user_ip','user_key'];

    public static function getPwdKey($strlen=5)
    {
        $str = '1234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM';
        $len = strlen($str);
        $code = '';
        for ($i=0; $i<$strlen; $i++) {
            $mt_str = mt_rand(0,$len-1);
            $code .= $str[$mt_str];
        }
        return $code;
    }
}
