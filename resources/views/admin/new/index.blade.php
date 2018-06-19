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
                        @csrf
                        <a class="layui-btn layui-btn-primary layui-btn-radius" id="btns">搜索</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <div style="padding: 40px;" id="news">
            {{--<div class="layui-col-sm12 layui-col-md9"><div class="layui-card"><div class="layui-card-header">标题</div><div class="layui-card-body">内容</div><div class="layui-card-header">作者</div></div></div>--}}
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
                    //console.log(res);////console.log(obj.status);//console.log(obj.msg);
                    var obj = JSON.parse(res);
                       //console.log(obj);
                       if(obj.status ==1) {
                         //查询成功
                           layer.msg( obj.msg, {icon: 1});
                         //显示出查询出来的内容
                           var data = JSON.parse(obj.list);
                           console.log(data.data);
                           console.log(data.data[0].title);
                           var strHtml = '';
                           $.each(data.data,function(index,value){
                               var str = "<div class=\"layui-col-sm12 layui-col-md9\"><div class=\"layui-card\"><div class=\"layui-card-header\"><a href="+value.url+">"+value.title+"</a></div><div class=\"layui-card-body\">"+value.content+"</div><div class=\"layui-card-header\">"+'作者:'+value.posterScreenName+'  时间:'+value.publishDate+"</div></div></div>";
                               strHtml += str;
                           });
                           $("#news").append().html(strHtml);
                       } else {
                         //查询失败
                           layer.msg( obj.msg, {icon: 2});
                       }
                   }
               });
           });
        });
    </script>
@endsection