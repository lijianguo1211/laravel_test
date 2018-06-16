@extends('admin/layout/base')
@section('content')
    <div class="layui-container">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>新闻搜索</legend>
    </fieldset>

    <div class="layui-row">
        <div class="layui-col-sm12 layui-col-md6 layui-col-md-offset3">
            <div class="layui-card">
                <div class="layui-card-header">
                    <form class="layui-form" id="form">
                         <input type="text" id="kw" name="title" class="layui-input">
                        <a class="layui-btn layui-btn-primary layui-btn-radius" id="btns">搜索</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        $(function(){
           $("#btns").click(function(){
               $.ajax({
                url:"{{url('admin/search')}}",
                type:"post",
                data:$("#form").serialize(),
                   success:function(res) {
                    console.log(res);
                   }
               });
           });
        });
    </script>
@endsection