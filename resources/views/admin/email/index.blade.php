@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>邮件测试</legend>
    </fieldset>
    <form class="layui-form"">
        <div class="layui-form-item">
            <label class="layui-form-label">邮件地址</label>
            <div class="layui-input-block">
                <input type="email" name="address" id="address" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">发送者</label>
            <div class="layui-input-block">
                <input type="text" name="sender" id="sender" class="layui-input">
                <div style="padding-bottom: 15px"></div>
                <input type="text" name="msg" id="msg" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <a class="layui-btn" id="btns">立即提交</a>
            </div>
        </div>
    </form>

@endsection
@section('js')
    <script>
        $(function(){
            $("#btns").click(function(){
                $.ajax({
                    url:"{{url('admin/send')}}",
                    type:"post",
                    data:{'address':$("#address").val(),'sender':$("#sender").val(),'msg':$("#msg").val(),'_token':'@csrf'},
                    dataType:"json",
                    success:function(res) {
                        console.log(res);
                    }
                });
            });
        });
    </script>

@endsection