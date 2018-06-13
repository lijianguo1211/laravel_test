@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>分类列表</legend>
    </fieldset>
    <div class="table-header">
        <a href="{{url('admin/type/create')}}">
            <i class="menu-icon fa fa-plus orange"></i>
            <span class="menu-text orange"> 添加分类 </span>
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
                <th>分类名</th>
                <th>父ID</th>
                <th>是否推荐</th>
                <th>是否上线</th>
                <th>添加时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $vo)
                <tr>
                    <td>{{$vo->type_id}}</td>
                    <td>{{str_repeat('--',$vo->level)}}{{$vo->type_name}}</td>
                    <td>{{$vo->type_pid}}</td>
                    <td>{{$vo->type_recommend}}</td>
                    <td>{{$vo->type_online}}</td>
                    <td>{{$vo->type_addtime}}</td>
                    <td>{{$vo->type_updatetime}}</td>
                    <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                            <a class="blue" href="/admin/type/{{$vo->type_id}}">
                                <i class="ace-icon fa fa-search-plus bigger-130"></i>
                            </a>

                            <a class="green" href="/admin/type/{{$vo->type_id}}/edit">
                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                            </a>

                            <a class="red" href="javascript:void(0);" onclick="">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection