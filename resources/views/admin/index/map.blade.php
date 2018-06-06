@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>调用百度接口测试</legend>
    </fieldset>
    <form class="layui-form" action="/admin/map_api">
        <div class="layui-form-item">
            <label class="layui-form-label">地点</label>
            <div class="layui-input-block">
                <input type="text" name="query" lay-verify="title" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">范围</label>
            <div class="layui-input-block">
                <input type="text" name="region" lay-verify="required" placeholder="请输入" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <button class="layui-btn">立即提交</button>
            </div>
        </div>
    </form>

@endsection