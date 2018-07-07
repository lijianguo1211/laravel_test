@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加实名认证</legend>
    </fieldset>

    <form class="layui-form" id="forms">
        <div class="layui-form-item">
            <label class="layui-form-label">真实姓名</label>
            <div class="layui-input-block">
                <input type="text" id="name" name="name" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份证号</label>
            <div class="layui-input-block">
                <input type="text" id="card" name="card" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份证正面</label>
            <div class="layui-input-block">
                <div class="layui-upload-drag" id="front_card">
                    <i class="layui-icon"></i>
                    <p>身份证正面</p>
                </div>
                <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                    预览图：
                    <div class="layui-upload-list" id="demo1"></div>
                </blockquote>
               {{-- <input type="text" id="front_card" name="front_card" class="layui-input">--}}
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">身份证背面</label>
                <div class="layui-input-block">
                    <div class="layui-upload-drag" id="bank_card">
                        <i class="layui-icon"></i>
                        <p>身份证背面</p>
                    </div>
                    {{--<input type="tel" id="bank_card" name="bank_card" autocomplete="off" class="layui-input">--}}
                </div>
        </div>

        @csrf
        <div class="layui-form-item">
            <div class="layui-input-block">
                <a class="layui-btn" id="btns">立即注册</a>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        var token = $('input[name=_token]').val();
        layui.use('upload', function() {
            var $ = layui.jquery
                , upload = layui.upload;

            //拖拽上传
            upload.render({
                elem: '#front_card'
                ,url: "{{ url('admin/uploadFile') }}"
                ,data: {'_token':token,'add_type':'1'}
                ,auto: false //选择文件后不自动上传
                ,bindAction: '#btns' //指向一个按钮触发上传
                ,choose: function(obj){
                    //将每次选择的文件追加到文件队列
                    var files = obj.pushFile();
                    //预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
                    obj.preview(function(index, file, result){
                        //console.log(index); //得到文件索引//console.log(file); //得到文件对象
                        //console.log(result); //得到文件base64编码，比如图片
                        //这里还可以做一些 append 文件列表 DOM 的操作
                        $('#demo1').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img" style="padding-right:20px;width: 10%;">')

                        //obj.upload(index, file); //对上传失败的单个文件重新上传，一般在某个事件中使用
                        //delete files[index]; //删除列表中对应的文件，一般在某个事件中使用
                    });
                }
                ,done: function(res){
                    console.log(res)
                    //上传完毕回调
                }
                ,error: function(res1){
                    //console.log(res1)
                    //请求异常回调
                }
                ,accept: 'images' //允许上传的文件类型
                ,size: 100 //最大允许上传的文件大小
                ,multiple:true//是否允许多文件上传,true-允许,false-不允许
                ,number:3//允许上传文件的张数
            });
            //拖拽上传
            upload.render({
                elem: '#bank_card'
                ,url: '/upload/'
                ,done: function(res){
                    //console.log(res)
                }
            });
        });

        $(function(){
            $("#btns").click(function(){
                if($("#name").val() == '') {
                    layer.msg( '真实姓名不能为空', {icon: 2});
                }
                if($("#card").val() == '') {
                    layer.msg( '身份证号不能为空', {icon: 2});
                }
                if($("#front_card").val() == '') {
                    layer.msg( '身份证正面照不能为空', {icon: 2});
                }
                if($("#bank_card").val() == '') {
                    layer.msg( '身份证背面照不能为空', {icon: 2});
                }
               $.ajax({
                    url:"{{ url('admin/add_admin') }}",
                    type:"post",
                    data:$("#forms").serialize(),
                    success:function(res) {
                        //console.log(res);
                       /*if(obj.status == 0) {
                            layer.msg(obj.mag,{icon:2})
                        } else {
                            layer.msg(obj.mag,{icon:1})
                            location.href = "";
                        }*/

                    }
                });
            });
        });
    </script>
@endsection
