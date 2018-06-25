@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加角色</legend>
    </fieldset>
    <form class="layui-form" id="forms">
        <div class="layui-form-item" id="csrf">
            <label class="layui-form-label">角色名字</label>
            <div class="layui-input-inline">
                <input type="text" name="name" id="name" lay-verify="title" placeholder="请输入角色名" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">权限状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="有效" checked="">
                <input type="radio" name="status" value="0" title="无效">
            </div>
        </div>

            @csrf
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
                    url:"{{url('admin/role_index_ajax')}}",
                    type:"post",
                    data:$("#forms").serialize(),
                    success:function(res) {
                        //console.log(res);
                        var obj = JSON.parse(res);
                        console.log(obj);
                        if(obj.status == 1) {
                            //查询成功
                            layer.msg(obj.msg, {icon: 1});
                        } else if(obj.status == 0) {
                            layer.msg(obj.msg, {icon: 2});
                        }
                    }
                });
            });
        });

    </script>
@endsection