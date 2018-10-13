<?php
/**
 * Created by PhpStorm.
 * User: "lijianguo"
 * Date: 2018/6/15
 * Time: 16:26
 */
/*class Models
{
    //定义是否需要自动填写时间戳
    //定义新增数据字段的白名单


}*/
    for ($i=0; $i<=100000000000000;$i++) {
        sleep(10);
        $file = __DIR__ . '/public/1.txt';
        file_put_contents($file, $i, FILE_APPEND | LOCK_EX);
    }

/**
 * laravel 中查看sql原生语句
 */


