<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRolePost;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Http\Controllers\Controller;

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
    public function index_list_ajax()
    {
        return view('admin/role/index_list_ajax');
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
}
