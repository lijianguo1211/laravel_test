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
        $type = new Type();
        $types = $type->getType();
        //var_dump($types);exit;
        return view('admin/type/create',compact('types'));
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
        empty($online) ? $online=0 : $online;
        empty($recommend) ? $recommend=0 : $recommend;
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
        $type = new Type();
        $types = $type->getType();
        if($types == null) {
            return back()->with(['status'=>0,'msg'=>'没有数据或查询失败']);
        }
        return view('admin/type/index',['list'=>$types]);
    }

    //编辑分类
    public function edit(Request $request,$id)
    {
        if(empty($id)) return back()->with(['status'=>0,'msg'=>'参数不对']);
        $type_list = Type::where(['type_id'=>$id])->first();
        //var_dump($type_list);exit;
        if($type_list == null) return back()->with(['status'=>0,'msg'=>'没有查询结果']);
        return view('admin/type/edit',compact('type_list'));
    }

    //编辑分类提交
    public function update(Request $request,$id)
    {
        //var_dump($request->all());exit;
        if(empty($id)) return back()->with(['status'=>0,'msg'=>'参数不对']);
        $type_model = new Type();
        $info = $request->all();
        $name = $info['name'];$title = $info['title'];$online = $info['online'];$recommend = $info['recommend'];
        $data = [
            'type_name' => $name,
            'type_pid'=> $title,
            'type_online' => $online,
            'type_recommend' => $recommend
        ];
        $type = $type_model::where(['type_id'=>$id])->update($data);
        //更新语句
        if(!$type) {
            return back()->with(['status'=>0,'msg'=>'修改失败']);
        }
        return redirect('admin/type')->with(['status'=>1,'msg'=>'修改完成']);
    }

    //查看具体某一个分类
    public function show(Request $request,$id)
    {
        if(empty($id)) return back()->with(['status'=>0,'msg'=>'参数不对']);
        $type_list = Type::where(['type_id'=>$id])->first();
        //var_dump($type_list);exit;
        if($type_list == null) return back()->with(['status'=>0,'msg'=>'没有查询结果']);
        return view('admin/type/show',compact('type_list'));
    }

    /**
     * @param $id
     */
    public function del($id)
    {
        //先查询是否有记录,在查询它下面是否有子分类,如果有子分类,就给一个异常
        $type_model = new Type();
        $type = $type_model::where(['type_id'=>$id])->first();
        if($type->first() == null) {
            $data = ['status'=>0,'msg'=>'没有查询结果'];
            $this->ajaxReturn($data);
        }
        $type_child = $type_model::where(['type_pid'=>$type['type_id']])->first();
        //var_dump($type_child->toArray());exit;
        if($type_child->first() != null) {
           $data = ['status'=>0,'msg'=>'请先删除它下面的子分类,再执行本次删除'];
           $this->ajaxReturn($data);
        }
        $type_del = $type_model::where(['type_id'=>$id])->delete();
        if($type_del) {
            $data = ['status'=>1,'msg'=>'删除分类成功'];
        } else {
            $data = ['status'=>0,'msg'=>'删除分类失败'];
        }
        $this->ajaxReturn($data);
    }
}
