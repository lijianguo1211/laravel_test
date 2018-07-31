<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function mail()
    {
        //测试数据
        $viewData = ['title' => '你若盛开，清风自来','author' => '木心'];
        $emailData = [
            'content' => '人最难控制的，不是别人，而是自己。做人要学会自信而不要自傲，果断而不武断，自尊而不自负，严谨而不拘束，知足而不满足，平常而不平庸，随和而不随便，放松而不放纵，认真而不较真。 ​​​​',
            'subject' => '小珍珍',//邮件主题
            'addr' => '270326786@qq.com',//邮件接收地址
        ];
        $this->sendText($emailData);
        //$this->sendHtml('mail',$viewData,$emailData);
        //TODO  $tag 判断发送是否成功，进行后续代码开发
        return view('admin/test/mail',['title' => '你若盛开，清风自来','author' => '木心']);
    }

    public function sendText($emailData)
    {
        //此处为文本内容
        $tag = $this->mailer
            ->raw($emailData['content'],
                function ($message)use ($emailData){
                    $message->subject($emailData['subject']);
                    $message->to($emailData['addr']);
                });
        return $tag;
    }

    /**
     * 发送自定义网页
     * @param $emailData 邮件数据
     * @param $viewPage html视图
     * @param $viewData html传输数据
     */
    public function sendHtml($viewPage,$viewData,$emailData)
    {
        $tag = $this->mailer
            ->send($viewPage,$viewData,
                function ($message) use ($emailData){
                    $message->subject($emailData['subject']);
                    $message->to($emailData['addr']);
                });
        return $tag;
    }

    /**
     * Notes:自定义邮件格式
     * User: "LiJinGuo"
     * Date: 2018/7/30
     * Time: 20:26
     * @return int
     */
    public function saveEmail()
    {
        $viewPage = 'admin.test.mail';
        //dd($viewPage);exit;
        $viewData = ['title' => '你若盛开，清风自来','author' => '木心','url'=>'http://img.ivsky.com/img/bizhi/slides/201805/19/solo_a_star_wars_story-002.jpg'];
        $emailData1 = [
            'content' => '人最难控制的，不是别人，而是自己。做人要学会自信而不要自傲，果断而不武断，自尊而不自负，严谨而不拘束，知足而不满足，平常而不平庸，随和而不随便，放松而不放纵，认真而不较真。 ​​​​',
            'subject' => '小珍珍',//邮件主题
            'addr' => '270326786@qq.com',//邮件接收地址
        ];
        $emailData = [
            'subject' => '光年之外',//邮件主题
            'addr' => '270326786@qq.com',//邮件接收地址
        ];
        //$result = $this->sendText($emailData);
        $result = $this->sendHtml($viewPage,$viewData,$emailData);
        return !$result ? 123 : 321;
    }

    public function index()
    {
        return view('admin/test/mail',['title' => '你若盛开，清风自来','author' => '木心']);
    }

    public function test2()
    {
        Mail::raw('恭喜你注册成功',function($message) {//内容,回调函数
            $message->subject('提醒激活邮件');//主题
            $message->to('270326786@qq.com');//接收人
        });
    }

    //测试redis的使用
    public function testRedis()
    {
        Redis::set('names','laravel-hello-world');
        $value = Redis::get('names');
        dd($value);
    }
}
