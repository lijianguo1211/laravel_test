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
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
