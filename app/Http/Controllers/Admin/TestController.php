<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //测试redis的使用
    public function testRedis()
    {
        Redis::set('names','laravel-hello-world');
        $value = Redis::get('names');
        dd($value);
    }
}
