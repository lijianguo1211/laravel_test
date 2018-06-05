<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //添加文章,显示表单
    public function create()
    {
        return view('admin/article/create');
    }

    //显示文章列表
    public function index()
    {

    }
}
