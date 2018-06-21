@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>调用百度接口测试</legend>
    </fieldset>
    <form id="forms">
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">文本域</label>
                <div class="layui-input-block">
                    <textarea name="test" id="test" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>
        @csrf
            <div class="layui-input-block">
                <a class="layui-btn" id="btns">立即提交</a>
            </div>
    </form>
@endsection
@section('js')
    <script type="text/javascript">
        $(function(){
            $("#btns").click(function(){
                $.ajax({
                    url:"{{url('admin/bd/save')}}",
                    type:"post",
                    data:$("#forms").serialize(),
                    success:function(res) {
                        console.log(res);
                    }
                })
            });
        });
    </script>
@endsection