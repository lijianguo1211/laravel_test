<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\User;
use App\Http\Requests\StoreUserPost;
use Illuminate\Support\Facades\Hash;
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
    public function add_admin(StoreUserPost $request)
    {
        //验证数据,接收数据
        $user_name = $request->get('user_name');
        $user_account = $request->get('user_account');
        $user_nickname = $request->get('user_nickname');
        $user_mobile = $request->get('user_mobile');
        $user_email = $request->get('user_email');
        $user_pwd = $request->get('user_pwd');
        $user_rpwd = $request->get('user_rpwd');
        $user_type = $request->get('user_type');
        if($user_pwd !== $user_rpwd) {
            $this->ajaxReturn(['status'=>0,'msg'=>'两次输入密码不一致']);
        }
        if(!$this->regexMobile($user_mobile)) {
            $this->ajaxReturn(['status'=>0,'msg'=>'手机号格式不对']);
        }
        $data = [
            'user_name'      => $user_name,
            'user_account'   => $user_account,
            'user_nickname'  => $user_nickname,
            'user_mobile'    => $user_mobile,
            'user_email'     => $user_email,
            'user_pwd'       => Hash::make($user_pwd),
            'user_type'      => $user_type,
            'user_logtime'   => date('Y-m-d H:i:s',time()),
            'user_ip'        => $request->getClientIp(),
        ];
        $result = User::create($data);
        if(!$result) {
            $this->ajaxReturn(['status'=>0,'msg'=>'新增用户失败']);
        }
        $this->ajaxReturn(['status'=>1,'msg'=>'新增用户成功']);
    }
}
