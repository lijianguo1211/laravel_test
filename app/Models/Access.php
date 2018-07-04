<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    //访问模型
    protected $table = 'access';

    public $timestamps = true;

    const CREATED_AT = 'access_addtime';
    const UPDATED_AT = 'access_updatetime';

    protected $fillable = ['access_pid','access_title','access_url','access_status'];

    /**
     * Notes:查询显示access表数据
     * User: "LiJinGuo"
     * Date: 2018/7/4
     * Time: 15:46
     * @param string $select
     * @param string $where
     * @param string $order
     * @return mixed
     */
    public function getAccessList($select='*',$where='',$order="")
    {
        if (empty($order)) {

        }
        $result = $this->select($select)->where($where)->orderBy('access_addtime','DESC')->get();
        return $result;
    }
}
