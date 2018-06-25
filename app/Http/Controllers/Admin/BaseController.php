<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Notes:http  get请求
     * User: "LiJinGuo"
     * Date: 2018/6/25
     * Time: 17:30
     * @param $url
     * @return mixed
     */
    public function getcurl($url)
    {
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//设置url属性
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);//获取数据
        curl_close($ch);//关闭curl
        return $output;
    }

    /** HTTPS get 请求
     * Notes:
     * User: "LiJinGuo"
     * Date: 2018/6/25
     * Time: 17:30
     * @param $url
     * @return mixed
     */
    public function getCurlHttps($url)
    {
        $req = curl_init();//初始化curl
        curl_setopt($req,CURLOPT_URL,$url);//设置请求链接
        //设置超时时长(秒)
        curl_setopt($req, CURLOPT_TIMEOUT,3);
        //设置链接时长
        curl_setopt($req, CURLOPT_CONNECTTIMEOUT,10);
        //设置头信息
        $headers=array( "Accept: application/json", "Content-Type: application/json;charset=utf-8" );
        curl_setopt($req, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($req, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($req);
        curl_close($req);
        return $data;
    }

    /**
     * Notes:ajax返回值
     * User: "LiJinGuo"
     * Date: 2018/6/25
     * Time: 17:30
     * @param array  $data
     * @param string $type
     */
    public function ajaxReturn($data = [],$type="json")
    {
        echo json_encode($data);exit;
    }

    public function dump(Array $arr=[],String $string='')
    {
        if(!empty($str)) {
            var_dump($str);
        }
        if(!empty($arr)) {
            echo '<pre>';
            print_r($arr);
            echo '</pre>';
        }
    }
}
