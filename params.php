<?php
/**
 * Created by PhpStorm.
 * User: "lijianguo"
 * Date: 2018/6/15
 * Time: 16:20
 */
//接受参数
class IndexController
{
    public function index(Request $request)
    {
        //接受单一参数
        $id = $request->get('id');
        //接受全部参数
        $info = $request->all();
        //参数过滤

        //

    }
}
