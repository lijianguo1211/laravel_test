<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewController extends Controller
{
    public function index()
    {
        return view('admin/new/index');
    }

    public function search(Request $request)
    {
        $kw = trim($request->get('title'));var_dump($kw);
        $kw = urlencode($kw);
        if(empty($kw)) {
            $data = ['status'=>0,'msg'=>'请输入关键词查询'];
            $this->ajaxReturn($data);
        }
        $apikey = 'BZIaJZmLL506tj6UE2XSiBTwIBtinQrTODCmsLqB2BuXmqbMb8g4eGngwcHQP79I';
        $url = "http://api01.bitspaceman.com:8000/news/qihoo?apikey=".$apikey.'&kw='.$kw;
        $jsonArr = $this->getcurl($url);
        dump($jsonArr);
    }
}
