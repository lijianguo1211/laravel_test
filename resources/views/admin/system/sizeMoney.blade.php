@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>大小写换算</legend>
    </fieldset>
    <form class="layui-form" id="form">
        <div class="layui-form-item">
            <label class="layui-form-label">小写</label>
            <div class="layui-input-inline">
                <input type="text" name="xiao" id="xiao" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item" id="csrf">
            <label class="layui-form-label">大写</label>
            <div class="layui-input-inline">
                <input type="text" name="da" id="da" class="layui-input">
            </div>
        </div>

            @csrf
            <div class="layui-form-item">
                <label class="layui-form-label"></label>
                <div class="layui-input-block">
                    <a onclick="getSize();" class="layui-btn">立即提交</a>
                </div>
            </div>
    </form>
@endsection
@section('js')
    <script>
        function getSize() {
            console.log('getsize');
            $.ajax({
                url:"{{ url('admin/ajaxSizeMoney') }}",
                type:"post",
                data:$("#form").serialize(),
                success:function(res) {
                    console.log(res);
                }
            });
        };
    </script>

@endsection