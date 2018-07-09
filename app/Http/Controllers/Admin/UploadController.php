<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Anchu\Ftp\Ftp;

class UploadController extends BaseController
{
    //文件上传

    /**
     * Notes:
     * User: "LiJinGuo"
     * Date: 2018/7/7
     * Time: 15:54
     * @param \Illuminate\Http\Request $request
     */
    public function uploadFile(Request $request)
    {
        $info = $request->all();
        //得到数组
        $files = $request->file();
        //遍历添加路径
        foreach ($files as $file) {
            //文件是否出错
            $res=$file->getError();
            if ($res !== 0) {
               $this->ajaxReturn(['status'=>0,'msg'=>'图片上传出错']);
            }
            //文件的类型是否正确
            $type=$file->getClientMimeType();
            if ($type != 'image/png' && $type !='image/jpeg' && $type !="image/gif" && $type !="image/jpg") {
                $this->ajaxReturn(['status'=>0,'msg'=>'上传图片类型不符合要求']);
            }
            //文件大小是否符合要求
            $size=$file->getClientSize();
            if ($size > 2*1024*1024) {
                $this->ajaxReturn(['status'=>0,'msg'=>'上传图片过大']);
            }
            //路径
            $ext = $this->getPrefixName($info['add_type']);
            //把要拼接的路径写在前面,后面是filesystems.php 的配置盘符
            $path=$file->store($ext,'my');
            //把路径传回前端
            $config = Config::get('filesystems');
            $test = $config['disks']['my']['url'];
            $paths = $test . '/' . $path;
        }
        $this->ajaxReturn(['status'=>1,'msg'=>'图片上传成功','path'=>$paths]);
    }

    /**
     * Notes:生成图片路径前缀
     * User: "LiJinGuo"
     * Date: 2018/7/7
     * Time: 15:56
     * @param $params
     */
    public function getPrefixName($params)
    {
        $add_type_of = [
            '1' => '/realName/'
        ];
        $add_type = $params;
        $type_name = $add_type_of[$add_type];
        if($add_type == 1) {
            $prefix_name = $type_name . date('Ymd').'/';
        }
        return $prefix_name;
    }

    public function fileUploadFtp()
    {
        echo 123;
        $ftp = new Ftp();
        $config = Config::get('ftp');
        var_dump($ftp->makeDir('123'));
    }

}
