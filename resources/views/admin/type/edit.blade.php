@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>修改文章分类</legend>
    </fieldset>
    <form class="layui-form" action="{{url('admin/type')}}{{'/' .$type_list->type_id}}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">分类标题</label>
            <div class="layui-input-block">
                <input type="text" name="name" required  lay-verify="required" placeholder="请输入分类标题" autocomplete="off" class="layui-input" value="{{$type_list->type_name}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">PID</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入分类标题" autocomplete="off" class="layui-input" value="{{$type_list->type_pid}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否上线</label>
            <div class="layui-input-block">
                <input type="radio" name="online" value="1" title="是" @if($type_list->type_online == 1) checked @endif>
                <input type="radio" name="online" value="0" title="否" @if($type_list->type_online == 0) checked @endif>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否推荐</label>
            <div class="layui-input-block">
                <input type="radio" name="recommend" value="1" title="是" @if($type_list->type_recommend == 1) checked @endif>
                <input type="radio" name="recommend" value="0" title="否" @if($type_list->type_recommend == 0) checked @endif>
            </div>
        </div>
        <div class="layui-form-item">
        <div class="layui-input-block">
        <button class="layui-btn" type="submit">立即提交</button>
        {{--lay-submit lay-filter="formDemo"--}}
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
        </div>
        @method('PUT')
        @csrf
    </form>


@endsection
@section('js')
    <script>
        // //Demo
        // layui.use('form', function(){
        //     var form = layui.form;
        //
        //     //监听提交
        //     form.on('submit(formDemo)', function(data){
        //         console.log(data);
        //         //layer.msg(JSON.stringify(data.field));
        //         //return false;
        //     });
        // });
    </script>
@endsection