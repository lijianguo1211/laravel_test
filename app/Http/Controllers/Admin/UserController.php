<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\User;
use Validator;

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
        if(collect($user_list)->isEmpty()) return back()->with(['status'=>0,'msg'=>'读取数据失败']);
        return view('admin/user/list',compact('user_list'));
    }

    //添加管理员
    public function add()
    {
        //管理员添加页面
        return view('admin/user/add');
    }

    //添加管理员提交
    public function add_admin(Request $request)
    {
        $messages = [
            'user_name.required' => '用户名不能为空',
            'user_account.required' => '用户账户不能为空',
            'user_nickname.required' => '用户昵称不能为空',
            'user_mobile.required' => '用户手机号不能为空',
            'user_email.required' => '用户邮箱不能为空',
            'user_pwd.required' => '用户密码不能为空',
        ];
        $validator = Validator::make($request->all(), [
            'user_name'     => 'required',
            'user_account'  => 'required',
            'user_nickname' => 'required',
            'user_mobile'   => 'required',
            'user_email'    => 'required',
            'user_pwd'      => 'required',
        ], $messages);
        /*$validator = $request->validate([
            'user_name'     => 'required',
            'user_account'  => 'required',
            'user_nickname' => 'required',
            'user_mobile'   => 'required',
            'user_email'    => 'required',
            'user_pwd'      => 'required',
        ]);*/
        if (!$validator->passes()) {
            return back()->withErrors($validator);
        }
        /*if ($validator->fails()) {
            return redirect('admin/adduser')
                ->withErrors($validator)
                ->withInput();
        }*/

    }
}
