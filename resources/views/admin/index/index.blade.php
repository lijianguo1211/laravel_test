@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>控制台</legend>
    </fieldset>
    <form class="layui-form" action="{{url('admin/city_api')}}" method="post">
        <div class="layui-form-item" id="csrf">
            <label class="layui-form-label">城市搜索</label>
            <div class="layui-input-inline">
                <input type="text" name="city" id="city" lay-verify="title" placeholder="请输入城市" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">选择查询问题</label>
                <div class="layui-input-inline">
                    <select name="type">
                        <option value="">请选择问题</option>
                        <option value="1">天气</option>
                        <option value="2">城市</option>
                    </select>
                </div>
            </div>

        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <button class="layui-btn">立即提交</button>
            </div>
        </div>
    </form>
@endsection
@section('js')
@endsection