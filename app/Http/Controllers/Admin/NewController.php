<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewController extends BaseController
{
    public function index()
    {
        return view('admin/new/index');
    }

    public function search(Request $request)
    {
        $kw = trim($request->get('title'));//var_dump($kw);
        $kw = urlencode($kw);
        //var_dump($kw);exit;
        if(empty($kw)) {
            $data = ['status'=>0,'msg'=>'请输入关键词查询'];
            $this->ajaxReturn($data);
        }
        $apikey = 'BZIaJZmLL506tj6UE2XSiBTwIBtinQrTODCmsLqB2BuXmqbMb8g4eGngwcHQP79I';
        $url = "http://api01.bitspaceman.com:8000/news/qihoo?apikey=".$apikey.'&kw='.$kw;
        $jsonArr = $this->getcurl($url);
        //var_dump($jsonArr);先判断是否查询成功
        $arr = json_decode($jsonArr,true);
        if($arr['retcode'] != '000000') {
            $data = ['status'=>0,'msg'=>'查询失败'];
            $this->ajaxReturn($data);
        }
        $data = ['status'=>1,'msg'=>'查询成功','list'=>$jsonArr];
        $this->ajaxReturn($data);
    }
}
