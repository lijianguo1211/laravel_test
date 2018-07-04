<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRolePost;
use App\Models\Access;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends BaseController
{
    //角色添加

    /**
     * Notes:显示角色列表
     * User: "LiJinGuo"
     * Date: 2018/6/26
     * Time: 9:17
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index_list()
    {
        return view('admin/role/index_list');
    }

    /**
     * Notes:显示角色列表ajax拉取页面
     * User: "LiJinGuo"
     * Date: 2018/6/26
     * Time: 9:17
     */
    public function index_list_ajax(Request $request)
    {
        //查询列表内容
        $key = $request->get('keyName');
        $lists = (new Role())->getRoleList($key);
        return view('admin/role/index_list_ajax',compact('lists'));
    }

    /**
     * Notes:角色添加页面
     * User: "LiJinGuo"
     * Date: 2018/6/25
     * Time: 16:03
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function role_index(Request $request)
    {
        $user_model = new User();
        $users = $user_model->select('user_id','user_name')->get();
        return view('admin/role/index',compact('users'));
    }

    /**
     * Notes:角色添加提交
     * User: "LiJinGuo"
     * Date: 2018/6/26
     * Time: 9:15
     * @param \Illuminate\Http\Request $request
     */
    public function role_index_ajax(Request $request)
    {
        /*$request->validate([
            'role_name'=>'bail|required|unique:ui_role'
        ]);*/

        $info = $request->all();
        if (empty($info['name'])) {
            $this->ajaxReturn(['status' => 0, 'msg' => '必传参数为空']);
        }
        //查看是否存在
        $result = (new Role())->where(['role_name'=>$info['name']])->first();
        if($result) {
            $this->ajaxReturn(['status' => 0, 'msg' => '该角色已存在']);
        }
        $data = [
            'role_name' => $info['name'],
            'role_status' => $info['status'],
        ];
        $role = Role::create($data)->toArray();
        if(!empty($role['role_name'])) {
            $this->ajaxReturn(['status' => 1, 'msg' => '插入数据成功']);
        } else {
            $this->ajaxReturn(['status' => 0, 'msg' => '插入数据失败']);
        }
    }

    /**
     * Notes:角色 | 管理用户关联
     * User: "LiJinGuo"
     * Date: 2018/7/2
     * Time: 14:11
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function role_user(Request $request)
    {
        if($request->ajax()) {
            $role_id = $request->get('role_id');
            $user_id = $request->get('user_id');
            if(empty($role_id) || empty($user_id)) {
                $this->ajaxReturn(['status'=>0,'nsg'=>'必传参数为空']);
            }
            $role_user_model = new UserRole();
            $data = [
                'role_id'  => $role_id,
                'user_id'  => $user_id,
            ];
            $result = $role_user_model::create($data);
            if(!$result) {
                $this->ajaxReturn(['status'=>'0','msg'=>'绑定角色失败']);
            }
            $this->ajaxReturn(['status'=>1,'msg'=>'绑定角色成功']);
        }
        $role_model = new Role();
        $user_model = new User();
        $roles = $role_model->select('role_id','role_name')->get();
        $users = $user_model->select('user_id','user_name')->get();
        if(empty($roles[0]->role_id) || empty($users[0]->user_id)) {
            return back()->with(['status'=>0,'msg'=>'数据不存在']);
        }
        return view('admin/role/role_user',compact('roles','users'));
    }

    /**
     * Notes:显示|处理 添加菜单
     * User: "LiJinGuo"
     * Date: 2018/7/4
     * Time: 19:55
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function access_index(Request $request)
    {
        //判断是否是ajax请求
        if ($request->ajax()) {
            //验证数据
            $validator = Validator::make($request->all(), [
                'access_pid'    => 'required',
                'access_title'  => 'required|unique:access|max:30',
                'access_url'    => 'required|unique:access|max:30',
                'access_status' => 'required',
            ],
                [
                    'access_pid.required'    => '顶级总管不能为空',
                    'access_title.required'  => '菜单不能为空',
                    'access_title.unique'    => '菜单已存在',
                    'access_title.max'       => '菜单最多30个字符',
                    'access_url.unique'      => '路由已存在',
                    'access_url.required'    => '路由不能为空',
                    'access_url.max'         => '路由最多30个字符',
                    'access_status.required' => '权限状态不能为空',
                ]);
            $errors = count($validator->getMessageBag()->toArray());
            if($errors > 0) {
                $this->ajaxReturn(['status'=>false,'errors'=>$validator->getMessageBag()->toArray()]);
            }
            //插入数据
            $result = Access::create($request->all());
            if ($result->count() == false) {
                $this->ajaxReturn(['status'=>0,'msg'=>'添加数据失败']);
            }
            $this->ajaxReturn(['status'=>1,'msg'=>'添加数据成功']);
        }
        $select = ['access_id','access_pid','access_title'];
        $where  = ['access_status'=>1];
        $access = (new Access())->getAccessList($select,$where);
        if ($access->count() == false) {
            $access = '';
        }
        return view('admin/role/access_index',compact('access'));
    }

    public function accessList(Request $request)
    {
        return view('admin/role/accessList');
    }

    public function accessListAjax(Request $request)
    {

            $key = $request->get('keyTitle');
            $select = ['access_id','access_status','access_title','access_updatetime','access_url'];
            $where['access_status']  = [1];
            //$where['access_title']   = ['like','%' . $key . '%'];
            $access = (new Access())->getAccessList($select,$where);var_dump($access);
            if ($access->count() == false) {
                $access = '';
            }
            return view('admin/role/accessListAjax',compact('access'));

    }
}
