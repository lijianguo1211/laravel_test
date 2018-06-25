<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends BaseController
{
    //角色添加

    /**
     * Notes:角色添加页面
     * User: "LiJinGuo"
     * Date: 2018/6/25
     * Time: 16:03
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function role_index(Request $request)
    {
        return view('admin/role/index');
    }

    public function role_index_ajax(Request $request)
    {
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
}
