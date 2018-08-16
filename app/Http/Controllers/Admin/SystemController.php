<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    //系统工具类
    protected $number = [
        0   => '零',
        1   => '壹',
        2   => '贰',
        3   => '叁',
        4   => '肆',
        5   => '伍',
        6   => '陆',
        7   => '柒',
        8   => '捌',
        9   => '玖',
    ];

    /**
     * @param String $str
     * @return array
     */
    protected function getSize(String $str)
    {
        $len = strlen($str);
        $result = [];
        for ($i = 0; $i < $len; $i++) {
            $res = '';
            switch ($str[$i]) {
                case 0 :
                    $res = $this->number[0];
                    break;
                case 1 :
                    $res = $this->number[1];
                    break;
                case 2 :
                    $res = $this->number[2];
                    break;
                case 3 :
                    $res = $this->number[3];
                    break;
                case 4 :
                    $res = $this->number[4];
                    break;
                case 5 :
                    $res = $this->number[5];
                    break;
                case 6 :
                    $res = $this->number[6];
                    break;
                case 7 :
                    $res = $this->number[7];
                    break;
                case 8 :
                    $res = $this->number[8];
                    break;
                case 9 :
                    $res = $this->number[9];
                    break;
            }
            $result[] = $res;
        }
        return $result;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sizeMoney()
    {
        return view('admin/system/sizeMoney');
    }

    /**
     * @param Request $request
     */
    public function ajaxSizeMoney(Request $request)
    {
        if (!$request->ajax()) {
            $this->ajaxReturn(['status'=>0,'msg'=>'数据提交方式错误']);
        }
        $info = $request->get('xiao');
        if (!isset($info)) {
            $this->ajaxReturn(['status'=>0,'msg'=>'请输入需要转换的数值']);
        }
        //把接收到的值转换为int类型
        $key = (int)$info;
        $result = $this->getSize($key);
        if (!is_array($result)) {
            $this->ajaxReturn(['status'=>0,'msg'=>'数据转换错误']);
        }
        //把数组的值全部赋值到字符串
        $arr = '';
        foreach ($result as $key => $value) {
            $arr .= $value;
        }
        $this->ajaxReturn(['status'=>1,'result'=>$arr]);
    }

    public function computer()
    {
        return view('admin/system/computer');
    }

    public function ajaxComputer(Request $request)
    {
        //判断提交方式
        if (!$request->ajax()) {
            $this->ajaxReturn(['status'=>0,'msg'=>'数据提交方式不对']);
        }
        //接收全部的值
        $info = $request->all();
        if (!isset($info['symbol']) || !isset($info['value1']) || !isset($info['value2'])) {
            $this->ajaxReturn(['status'=>0,'msg'=>'请选择要计算的数值或类型']);
        }
        $symbol = $info['symbol'];
        $value1 = $info['value1'];
        $value2 = $info['value2'];
        $result = '';
        switch ($symbol) {
            case 0:
                //加法
                $result = bcadd($value1,$value2);
                break;
            case 1:
                //减法
                $result = bcsub($value1,$value2);
                break;
            case 2:
                //乘法
                $result = bcmul($value1,$value2);
                break;
            case 3:
                //除法
                $result = bcdiv($value1,$value2,2);
                break;
            case 4:
                //求余
                $result = bcmod($value1,$value2);
                break;
            case 5:
                //平方根
                //$result = bcpow($value1,$value2);
                $this->ajaxReturn(['status'=>0,'msg'=>'后续功能还在开发中']);
                break;
            case 6:
                //次方
                $result =bcpow($value1,$value2,2);
                break;
        }
        $this->ajaxReturn(['status'=>1,'result'=>$result]);
    }
}
