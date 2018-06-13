<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    private $address;

    public function __construct()
    {

    }

    public function index()
    {
        return view('admin/email/index');
    }

    public function send()
    {
        $data = $_REQUEST;
        $sender = trim($_REQUEST['sender']);
        $address = trim($_REQUEST['address']);
        $msg = trim($_REQUEST['msg']);
        $this->adress = $address;
        $falg = Mail::send('emails.ordershipped',['name'=>$snder,'address'=>$address],function($msg){
                $to = $this->address;
                $msg->to($to)->subjiect('测试邮件');
        });

        if(!$falg) {
            return json_encode(['status'=>1,'msg'=>'发送邮件成功,请查收']);
        } else {
            return json_encode(['status'=>0,'msg'=>'发送邮件失败,请重试']);
        }
    }
}
