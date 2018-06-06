<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    public $timestamps = true;
    const CREATED_AT = 'type_addtime';
    const UPDATED_AT = 'type_updatetime';

    protected $fillable = ['type_name','type_pid','type_online','type_recommend'];

    public function getTypeOnlineAttribute($value)
    {
        $status =  [0=>'否',1=>'是'];
        return $status[$value];
    }

    /*public function setTypeOnlineAttribute($value)
    {
        $status = ['否'=>0,'是'=>1];
        return $status[$value];
    }*/

    public function getTypeRecommendAttribute($value)
    {
        $status =  [0=>'否',1=>'是'];
        return $status[$value];
    }

   /* public function setTypeRecommendAttribute($value)
    {
        $status = ['否'=>0,'是'=>1];
        return $status[$value];
    }*/

    //调取分类
    public function getType($pid=0,$target = [])
    {
        $type = $this->where('type_pid','=',$pid)->get();
        //$id = $type['type_id'];
        static $n = 1;
        foreach($type as $k => $v) {
            $v->level = $n;
            $target[$v->type_id] = $v;
            $n++;
            $target = $this->getType($v->type_id,$target);
            $n--;
        }
        return $target;
    }
}
