<?php
/**
 * Created by PhpStorm.
 * User: "lijianguo"
 * Date: 2018/5/24
 * Time: 20:07
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index(Request $request)
    {
        return view('admin/index/index');//需要定义路由,在浏览器输入admin/index 访问
    }

    public function map()
    {
        return view('admin/index/map');
    }

    public function map_api(Request $request)
    {
        $query = $request->get('query');
        $region = $request->get('region');
        if(empty($query) || empty($region)) {
            return back()->with(['status'=>0,'msg'=>'缺少参数']);
        }
        $ak = 'HnDqo6bWWRQtzyRdqB7v8imEI3gmP289';
        $url = "http://api.map.baidu.com/place/v2/suggestion?query=$query&region=$region&city_limit=true&output=json&ak=$ak";
        $jsonArr = $this->getcurl($url);
        //dump($jsonArr);exit;
        return view('admin/index/map_api',compact($jsonArr));
    }
}


