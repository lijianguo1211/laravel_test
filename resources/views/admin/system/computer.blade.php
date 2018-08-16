@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>简单数字计算</legend>
    </fieldset>
    <form class="layui-form" id="form">
        <div class="layui-form-item">
            <label class="layui-form-label">数值</label>
            <div class="layui-input-inline">
                <input type="number" name="value1" id="value1" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">符号</label>
            <div class="layui-input-inline">
                    <select name="symbol" lay-verify="required">
                        <option value="0">加</option>
                        <option value="1">减</option>
                        <option value="2">乘</option>
                        <option value="3">除</option>
                        <option value="4">求余</option>
                        <option value="5">平方根</option>
                        <option value="6">次方</option>
                    </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">数值</label>
            <div class="layui-input-inline">
                <input type="number" name="value2" id="value2" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">结果</label>
            <div class="layui-input-inline">
                <input type="text" name="result" id="result" class="layui-input">
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
            $.ajax({
                url:"{{ url('admin/ajaxComputer') }}",
                type:"post",
                data:$("#form").serialize(),
                success:function(res) {
                    //数据转换
                    var obj = JSON.parse(res);
                    if (obj.status == 0) {
                        layer.msg(obj.msg,{icon:5});
                    } else {
                        $("#result").val(obj.result);
                    }
                }
            });
        };
    </script>

@endsection