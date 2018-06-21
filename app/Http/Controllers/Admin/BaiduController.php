<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class BaiduController extends BaseController
{
    /**
     * Notes:显示百度语音合成页面
     * User: "LiJinGuo"
     * Date: 2018/6/21
     * Time: 15:57
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin/bd/index');
    }

    /**
     * Notes:前台传过来的文字调用百度接口翻译成mp3
     * User: "LiJinGuo"
     * Date: 2018/6/21
     * Time: 16:15
     * @param \Illuminate\Http\Request $request
     */
    public function save(Request $request)
    {
        //接受文本消息
        $test = $request->get('test');
        if(empty($test)) {
            $this->ajaxReturn(['status'=>0,'msg'=>'缺少必传参数']);
        }
        $AppID = '11426448';
        //$ApiKey = 'StbsLBfHfPwLUOafmopLOMPZ';
        //$SecretKey = 'kUKK1GGA8jkBzF2r8kdDzTaqyxPDmAOR';
        //$url1 = 'https://openapi.baidu.com/oauth/2.0/token?grant_type=client_credentials&client_id='.$ApiKey.'&client_secret='.$SecretKey;
        //$result1 = $this->getCurlHttps($url1);
        //$result2 = json_decode($result1,true);
        //dump($result2['access_token']);exit;
        /*if(empty($result2['access_token'])) {
            $this->ajaxReturn(['status'=>0,'msg'=>'获取token失败']);
        }*/
        $test = urlencode($test);
        $userID = 'c1a2ee5de28a4b6b8769cdb2a5f4e4e5';
        $url2 = 'http://tsn.baidu.com/text2audio?tex='.$test.'&lan=zh&cuid='.$userID.'&ctp=1&tok=24.cb7dbce8af35fd0f4f70b1b85dd48f0c.2592000.1532162333.282335-11426448';
        $result3 = $this->getcurl($url2);
    }
}
