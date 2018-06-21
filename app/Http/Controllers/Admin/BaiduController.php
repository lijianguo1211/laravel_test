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
        $ApiKey = 'StbsLBfHfPwLUOafmopLOMPZ';
        $SecretKey = 'kUKK1GGA8jkBzF2r8kdDzTaqyxPDmAOR';
        $url1 = 'https://openapi.baidu.com/oauth/2.0/token?grant_type=client_credentials&client_id='.$ApiKey.'&client_secret='.$SecretKey;
        $result1 = $this->getCurlHttps($url1);
        $result2 = json_decode($result1,true);
        //dump($result2['access_token']);exit;
        $token = $result1['access_token'];
        $test = urlencode($test);
        #发音人选择, 0为普通女声，1为普通男生，3为情感合成-度逍遥，4为情感合成-度丫丫，默认为普通女声
        $per = 4;
        #语速，取值0-9，默认为5中语速
        $spd = 5;
        #音调，取值0-9，默认为5中语调
        $pit = 5;
        #音量，取值0-9，默认为5中音量
        $vol = 5;
        $userID = 'c1a2ee5de28a4b6b8769cdb2a5f4e4e5';
        //$cuid = "123456PHP";
        $params = array(
            'tex' => $test,
            'per' => $per,
            'spd' => $spd,
            'pit' => $pit,
            'vol' => $vol,
            'cuid' => $userID,
            'tok' => $token,
            'lan' => 'zh', //固定参数
            'ctp' => 1, // 固定参数
        );
        $url2 = 'http://tsn.baidu.com/text2audio?' . http_build_query($params);
        $g_has_error = true;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        function read_header($ch, $header){
            global $g_has_error;

            $comps = explode(":", $header);
            // 正常返回的头部 Content-Type: audio/mp3
            // 有错误的如 Content-Type: application/json
            if (count($comps) >= 2){
                if (strcasecmp(trim($comps[0]), "Content-Type") == 0){
                    if (strpos($comps[1], "mp3") > 0 ){
                        $g_has_error = false;
                    }else{
                        echo $header ." , has error \n";
                    }
                }
            }
            return strlen($header);
        }
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'read_header');
        $data = curl_exec($ch);
        if(curl_errno($ch))
        {
            echo curl_error($ch);
            exit;
        }
        curl_close($ch);

        $file = $g_has_error ? "result.txt" : "result.mp3";
        file_put_contents($file, $result3);
    }
}
