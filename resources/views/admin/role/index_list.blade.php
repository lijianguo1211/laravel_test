@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>角色列表</legend>
    </fieldset>
    <div class="table-header">
        <a href="{{url('admin/role_index')}}">
            <i class="menu-icon fa fa-plus orange"></i>
            <span class="menu-text orange"> 添加角色 </span>
        </a>
        <a href="{{url('admin/role_user')}}">
            <i class="menu-icon fa fa-plus orange"></i>
            <span class="menu-text orange"> 绑定角色 </span>
        </a>
    </div>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>ID</th>
                <th>角色名称</th>
                <th>关联用户</th>
                <th>格言</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection

@section('js')
    $(function(){

    })
@endsection
