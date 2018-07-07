<?php
/**
 * Created by PhpStorm.
 * User: "lijianguo"
 * Date: 2018/7/6
 * Time: 20:01
 */
namespace App\Http\Controllers\Admin;

class CardIdController extends BaseController
{
    //实名认证管理

    /**
     * Notes:实名认证显示页面
     * User: "LiJinGuo"
     * Date: 2018/7/7
     * Time: 10:51
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin/card/index');
    }
}