<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminPost extends FormRequest
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
            'user_name' => 'max:30',
            'user_emial' => 'email',
            'user_mobile' => 'digits:11',
            'user_pwd'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_name.max'         => '用户名最多30位',
            'user_email.email'      => '邮箱格式不正确',
            'user_mobile.digits'    => '手机号是11位',
            'user_pwd.required'     => '必须输入手机号',
        ];
    }
}
