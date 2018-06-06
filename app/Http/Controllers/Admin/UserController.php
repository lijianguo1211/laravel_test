<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    //后台登录
    public function index()
    {
        return view('admin/user/index');
    }

    //登录提交
    public function login(Request $request)
    {
        $user = $request->get('user');
        $pwd  = $request->get('pwd');
        if(empty(trim($user)) || empty(trim($pwd))) {
            return back()->with(['status'=>0,'msg'=>'信息填写不全']);
        }
        $user_info = User::where('user_name',$user)->first();
        if(empty($user_info) || $user_info['user_pwd'] != md5($pwd)) {
            return back()->with(['status'=>0,'msg'=>'用户名不存在或密码错误']);
        }
        $users = ['user_id'=>$user_info['user_id'],'user_name'=>$user_info['user_name']];
        //var_dump($user_info);exit;
        session('users',$users);
        return redirect('admin/index');
    }

    //查看管理员列表
    public function list()
    {
        $user_list = User::select(['user_id','user_name','user_account','user_nickname','user_email','user_mobile'])->get();
        //var_dump($user_list);exit;
        return view('admin/user/list',compact('user_list'));
    }

    //添加管理员
    public function add()
    {
        return view('admin/user/add');
    }
}
