<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolePost extends FormRequest
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
            'role_name' => 'required|unique:role'
        ];
    }

    public function messages()
    {
        return [
          'role_name.required' => '角色名称不能为空',
          'role_name.unique'   => '角色名称已存在',
        ];
    }
}
