<?php
/**
 * @Notes:
 * Created by PhpStorm.
 * @Date: 2018/9/27
 * @Time: 16:47
 * @User: LiYi
 */
namespace App\Http\Controllers\Common;

class TestSshController
{
    public function index($host, $port = 22, $ssh_username, $ssh_password, $command)
    {
        /**
         * 利用ssh执行 远程或本地liunx服务器命令
         * 虽然可以用 shee_exec来执行本地机命令 但却无法选择用哪个用户来执行 此函数可解决此类问题
         * $host ssh 主机名 可以为ip 或 域名
         * $port ssh 端口 * $ssh_username ssh 登录用户名
         * $ssh_password ssh 登录密码
         * $command 要执行的liunx命令
         * 反回值行结果和错误信息
         */
        $con = ssh2_connect($host, $port);
        $auth_methods = ssh2_auth_none($con, $ssh_username);
        if (in_array('password', $auth_methods)) {
            //是否允许使用密码登陆
             $auth_methods = ssh2_auth_password($con, $ssh_username, $ssh_password);

             }
             $stdout_stream = ssh2_exec($con, $command);
             $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);
             stream_set_blocking($stdout_stream, true);
             //阻塞执行
             stream_set_blocking($err_stream, true);
             $result_stdout = stream_get_contents($stdout_stream);
             $result_error = stream_get_contents($err_stream);
             fclose($stdout_stream);
             fclose($err_stream);
             return array('result' => $result_stdout, 'error' => $result_error);
    }

}