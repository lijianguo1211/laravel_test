<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => 'required|string|max:50',
            'user_nickname' => 'required|string|max:30',
            'user_mobile' => 'required|string|max:30',
            'user_type' => 'required|int|max:1',
            'user_email' => 'required|string|email|max:30|unique:ui_user',
            'user_pwd' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data,Request $request)
    {
        $str = 'ZXCVBNMLKJHGFDSAQWERTYUIOPpoiuytrewqasdfghjklmnbvcxz';
        $lenstr = strlen($str);
        $rand = '';
        for ($i=0; $i<=1; $i++) {
            $code = mt_rand(0,$lenstr-1);
            $rand .= $code;
        }
        echo $rand;
        exit;
        $account = 'LM'.'_'.mt_rand(1111,9999) . $rand . mt_rand(1111,9999);
        return User::create([
            'user_name' => $data['name'],
            'user_email' => $data['email'],
            'user_pwd' => Hash::make($data['password']),
            'user_nickname' => $data['nickname'],
            'user_mobile' => $data['mobile'],
            'user_type' => mt_rand(1,5),
            'user_logtime' => date('Y-m-d H:i:s',time()),
            'user_ip'  => $request->getClientIp(),
            'user_value' => 20,
            'user_account' => $account,
        ]);
    }
}
