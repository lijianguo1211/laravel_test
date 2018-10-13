<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/1/001
 * Time: 0:48
 */
namespace App\Http\Controllers\Common;

class TestController
{
    public function index()
    {
        $test = new CreateTreeRootController(0,1);
        $test->AddNode(3,0,0);
        /*$test->AddNode(4,1,0);
        $test->AddNode('A',1,3);
        $test->AddNode('B',0,4);*/
        dd($test);
        dd($test->PreOrderTraversal());
        dd($test->InOrderTraversal());
        dd($test->PostOrderTraversal());
    }

    public function test()
    {
        dd(123456);
    }



    /**
     * gps查询
     */
    public function getLocationGps($item,$var)
    {
        $res = [];
        if (empty($res)) {

        }
    }

    /*
     * 基站查询
     */
    public function getLocationAt()
    {

    }

    /**
     * wifi查询
     */
    public function getLocationWifi()
    {

    }

    /**
     * ip查询
     */
    public function getLocationIp()
    {

    }

    /**
     * 数据库查询是否有具体信息
     * $item String 代表具体的mac值或者at值
     * return false | array
     */
    public function getLocationSqlAt($item)
    {
        $result = DB::table('mac_at_location')->where('at',$item)->first();
        if (!empty($result) && !empty($result['address'])) {
            return $result;
        }
        return false;
    }

    public function getLocationSqlWifi($item)
    {
        $item = strtoupper(trim($item));
        $mac_s = explode(',',$item);
        foreach ($mac_s as $k => $v) {
            $result = DB::table('mac_at_location')->where('mac',$v)->first();
            if (!empty($result) && !empty($result['address'])) {
                return $result;
            }
        }
        return false;
    }

    /**
     * @Notes:条件判断
     * @Date: 2018/9/17
     * @Time: 11:09
     * @User: LiYi
     * @param $param
     * @param $var
     */
    public function getCondition($param,$var)
    {
        switch ($var) {
            case 'at':
                $str = 'at';
                break;
            case 'wifi':
                $str = 'wifi';
                break;
            case 'ip':
                $str = 'ip';
                break;
        }
        if (!empty($param[$str]) && isset($param[$str])) {

        }
    }

    public function CompareLocation()
    {
        switch ($str) {
            case 1 :

                break;
            case 2 :

                break;
            case 3 :

                break;
            case 4 :

                break;
        }
    }

}