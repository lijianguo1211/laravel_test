<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAdminPost;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    //后台登录
    /**
     * Notes:后台登录界面显示
     * User: "LiJinGuo"
     * Date: 2018/8/1
     * Time: 10:57
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin/admin/index');
    }

    public function registerAdmin(Request $request)
    {
        //接收数据StoreAdminPost
        if (!$request->isMethod('post')) {
            return back()->with(['status'=>0,'msg'=>'请求方法错误']);
        }
        $key = trim($request->get('form-username'));
        $value = trim($request->get('form-password'));
        $sw = '';
        if (preg_match('/^0?1[3|4|5|6|7|8][0-9]\d{8}$/',$key)) {
            $sw = 1;//手机登录
        } elseif (preg_match('/\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/',$key)) {
            $sw = 2;//邮箱登录
        } elseif (preg_match('/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u',$key)) {
            $sw = 3;//用户名登录
        }
        $where = '';
        switch ($sw) {
            case 1:
            //手机
                if(!$this->regexMobile($key)) {
                    return back()->with(['status'=>0,'msg'=>'手机号格式不对']);
                }
                $where = 'user_mobile';
                break;
            case 2:
            //邮箱
                if(!preg_match('/\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/',$key)) {
                    return back()->with(['status'=>0,'msg'=>'邮箱格式不对']);
                }
                $where = 'user_email';
                break;
            case 3:
            //用户名
                $where = 'user_name';
                break;
            default:
            //账户id
                $where = 'user_account';
                break;
        }
        //查询是否存在此条记录
        $result = (new User())->select('user_pwd')->where($where,'=',$key)->first();
        if (!$result) {
            return back()->with(['status'=>0,'msg'=>'不存在该用户']);
        }
        if ($result->user_pwd != $value) {
            return back()->with(['status'=>0,'msg'=>'密码输入不正确']);
        }
        return redirect('admin/index');
    }
}
