@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>绑定角色</legend>
    </fieldset>
    <form class="layui-form" id="forms">
            <div class="layui-inline">
                <label class="layui-form-label">角色名</label>
                <div class="layui-input-inline">
                    <select name="role_id" lay-verify="required" lay-search="">
                        <option value="">直接选择或搜索选择</option>
                        @foreach($roles as $v)
                            <option value="{{$v->role_id}}">{{$v->role_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        <div class="layui-inline">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-inline">
                <select name="user_id" lay-verify="required" lay-search="">
                    <option value="">直接选择或搜索选择</option>
                    @foreach($users as $v)
                    <option value="{{$v->user_id}}">{{$v->user_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @csrf
        <div class="layui-inline">
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
                    url:"{{url('admin/role_user')}}",
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