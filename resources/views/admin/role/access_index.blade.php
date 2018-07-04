@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加菜单</legend>
    </fieldset>
    <form class="layui-form" id="forms">
        <div class="layui-inline">
            <label class="layui-form-label">选择添加顶级菜单</label>
            <div class="layui-input-inline">
                <select name="access_pid" lay-verify="required" lay-search="">
                    <option value="0">顶级选择</option>
                    @if($access != '')
                    @foreach($access as $val)
                    <option value="{{ $val['access_id'] }}">{{ $val['access_title'] }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">菜单名字</label>
            <div class="layui-input-inline">
                <input type="text" name="access_title" id="" placeholder="请输入菜单名" class="layui-input">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">路由名</label>
            <div class="layui-input-inline">
                <input type="text" name="access_url" id="" class="layui-input">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">权限状态</label>
            <div class="layui-input-block">
                <input type="radio" name="access_status" value="1" title="有效" checked="">
                <input type="radio" name="access_status" value="0" title="无效">
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
        $("#btns").click(function(){
            $.ajax({
                url:"{{ url('admin/access_index_ajax') }}",
                type:"post",
                data:$("#forms").serialize(),
                success:function(res) {
                    console.log(res);
                    var obj = JSON.parse(res);
                    if(obj.status === false) {
                        console.log(obj.errors);
                        $.each(obj.errors,function(key,value){
                            $.each(value,function(k,v){
                                layer.msg(v,{icon:2})
                            })
                        })
                    }
                    if(obj.status === 0) {
                        layer.msg(obj.msg,{icon:2})
                    } else if (obj.status === 1) {
                        layer.msg(obj.msg,{icon:1})
                         location.href = location.href;
                    }
                }
            })
        })
    </script>
@endsection