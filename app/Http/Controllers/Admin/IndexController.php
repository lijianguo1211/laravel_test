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

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('admin/index/index');//需要定义路由,在浏览器输入admin/index 访问
    }
}


