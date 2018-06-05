@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>管理员列表</legend>
    </fieldset>
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
                <th>用户名</th>
                <th>账户id</th>
                <th>昵称</th>
                <th>邮箱</th>
                <th>手机</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $vo)
            <tr>
                <td>{{$vo->user_id}}</td>
                <td>{{$vo->user_name}}</td>
                <td>{{$vo->user_account}}</td>
                <td>{{$vo->user_nickname}}</td>
                <td>{{$vo->user_email}}</td>
                <td>{{$vo->user_mobile}}</td>
                <td>删除</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection