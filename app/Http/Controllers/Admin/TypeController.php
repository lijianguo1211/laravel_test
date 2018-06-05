<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;

class TypeController extends Controller
{
    //添加文章分类表单
    public function create()
    {
        return view('admin/type/create');
    }

    //添加文章分类提交保存
    public function store(Request $request)
    {
        $name = $request->get('title');
        $pid  = $request->get('pid');
        $online = $request->get('online');
        $recommend = $request->get('recommend');
        if(empty(trim($name)) || !isset($pid)) {
            return back()->with(['status'=>0,'msg'=>'参数不全']);
        }
        $data = [
            'type_name'         =>$name,
            'type_pid'          =>$pid,
            'type_online'       => $online,
            'type_recommend'    => $recommend
        ];
        $type = Type::create($data);
        if(!$type) {
            return back()->with(['status'=>0,'msg'=>'插入数据失败']);
        }
        return redirect('admin/type');


    }

    //查看分类
    public function index()
    {
        $list = Type::all();//select()可以指定字段
        if($list == null) {
            return back()->with(['status'=>0,'msg'=>'没有数据或查询失败']);
        }
        return view('admin/type/index',['list'=>$list]);
    }

    //编辑分类
    public function edit()
    {

    }

    //编辑分类提交
    public function save()
    {

    }

    //查看具体某一个分类
    public function show()
    {

    }

}
