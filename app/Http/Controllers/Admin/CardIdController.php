<?php
/**
 * Created by PhpStorm.
 * User: "lijianguo"
 * Date: 2018/7/6
 * Time: 20:01
 */
namespace App\Http\Controllers\Admin;
use Ofcold\IdentityCard\IdentityCard;
use Illuminate\Http\Request;
use App\Models\RealName;

class CardIdController extends BaseController
{
    //实名认证管理

    /**
     * Notes:实名认证显示页面
     * User: "LiJinGuo"
     * Date: 2018/7/7
     * Time: 10:51
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin/card/index');
    }

    public function getIndex(Request $request)
    {
        var_dump($request->all());exit;
        $name    = trim($request->get('name'));
        $card    = trim($request->get('card'));
        $user_id = $request->get('user_id');
        if(empty($name) || empty($card)) {
            $this->ajaxReturn(['status'=>0,'msg'=>'必传参数为空']);
        }
        if(mb_strlen($name) > 30 || strlen($card) != 18) {
            $this->ajaxReturn(['status'=>0,'msg'=>'参数位数不对']);
        }
        $card1 = IdentityCard::make($card);
        $card_arr = json_decode($card1,true);
        if (empty($card_arr['county'])) {
            $card_arr['county'] = '';
        }
        $gender = [
            '男'      => 0,
            '女'      => 1,
            '保密'    => 2,
        ];
        $card_arr['gender'] = $gender[$card_arr['gender']];
        $data = [
            'name'    =>  $name,
            'card'    =>  $card,
            'user_id' =>  1,
            'front_card'=> '',
            'bank_card' => '',
            'province' => $card_arr['province'],
            'city' => $card_arr['city'],
            'county' => $card_arr['county'],
            'gender' => $card_arr['gender'],
            'birthday' => $card_arr['birthday'],
            'zodiac' => $card_arr['zodiac'],
            'age' => $card_arr['age'],
            'constellation' => $card_arr['constellation'],
        ];
        $result = RealName::create($data);
        if ($result == false) {
            $this->ajaxReturn(['status'=>0,'msg'=>'添加实名认证失败']);
        }
        $this->ajaxReturn(['status'=>0,'msg'=>'添加实名认证成功']);
    }
}