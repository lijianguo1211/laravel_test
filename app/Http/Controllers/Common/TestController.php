<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/1/001
 * Time: 0:48
 */
namespace App\Http\Controllers\Common;

class TestController
{
    public function index()
    {
        $test = new CreateTreeRootController(0,1);
        $test->AddNode(3,0,0);
        $test->AddNode(4,1,0);
        $test->AddNode('A',1,3);
        $test->AddNode('B',0,4);
        dd($test);
        dd($test->PreOrderTraversal());
        dd($test->InOrderTraversal());
        dd($test->PostOrderTraversal());
    }

    public function test()
    {
        dd(123456);
    }
}