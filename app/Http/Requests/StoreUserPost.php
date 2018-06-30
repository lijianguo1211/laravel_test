<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'user_name'     => 'require',
           'user_account'  => 'required',
           'user_nickname' => 'required',
           'user_mobile'   => 'required',
           'user_email'    => 'required',
           'user_pwd'      => 'required',
           'user_type'     => 'required',
           'user_rpwd'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required'        => '用户名不能为空',
            'user_account.required'     => '用户账户不能为空',
            'user_nickname.required'    => '用户昵称不能为空',
            'user_mobile.required'      => '用户手机号不能为空',
            'user_email.required'       => '用户邮箱不能为空',
            'user_pwd.required'         => '用户密码不能为空',
            'user_rpwd.required'        => '再次输入密码不能为空',
            'user_type.required'        => '用户类型必须选择'
        ];
    }
}
