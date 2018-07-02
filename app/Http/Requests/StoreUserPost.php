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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'user_name'     => 'required|unique:user|max:30',
           'user_account'  => 'required|unique:user|max:30',
           'user_nickname' => 'required|max:20',
           'user_mobile'   => 'required|unique:user|digits:11',
           'user_email'    => 'required|email|unique:user',
           'user_pwd'      => 'required|alpha_num|max:20|min:6',
           'user_type'     => 'required',
           'user_rpwd'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required'        => '用户名不能为空',
            'user_name.unique'          => '用户名已存在',
            'user_name.max'             => '用户名最大长度为30',
            'user_account.required'     => '用户账户不能为空',
            'user_account.unique'       => '用户名已存在',
            'user_account.max'          => '用账户最大长度为30',
            'user_nickname.required'    => '用户昵称不能为空',
            'user_nickname.max'         => '用户昵称最大长度为20',
            'user_mobile.required'      => '用户手机号不能为空',
            'user_mobile.unique'        => '用户手机号已存在',
            'user_mobile.digits'        => '用户手机号为11位',
            'user_email.required'       => '用户邮箱不能为空',
            'user_email.email'          => '用户邮箱格式不正确',
            'user_email.unique'         => '用户邮箱已存在',
            'user_pwd.required'         => '用户密码不能为空',
            'user_pwd.alpha_num'        => '用户密码只能是数字和字母',
            'user_pwd.max'              => '用户密码最大长度为20',
            'user_pwd.min'              => '用户密码最少长度为6',
            'user_rpwd.required'        => '再次输入密码不能为空',
            'user_type.required'        => '用户类型必须选择'
        ];
    }

    // woo 改变验证后的默认行为： 变成 ajax
    public function failedValidation( \Illuminate\Contracts\Validation\Validator $validator ) {
        exit(json_encode(array(
            'success' => false,
            'message' => 'There are incorect values in the form!',
            'errors' => $validator->getMessageBag()->toArray()
        )));
    }

}
