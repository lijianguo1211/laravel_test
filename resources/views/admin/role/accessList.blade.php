@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>菜单列表</legend>
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
        <a href="{{url('admin/access_index')}}">`
            <i class="menu-icon fa fa-plus orange"></i>
            <span class="menu-text orange"> 添加菜单 </span>
        </a>
    </div>

    <div class="layui-col-md4 layui-col-md-offset8">
        <form id="forms">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">输入菜单名</label>
                    <div class="layui-input-inline">
                        <input type="text" name="keyTitle"  placeholder="菜单名...." class="layui-input">
                    </div>
                </div>

                <div class="layui-inline">
                    <button class="layui-btn layui-btn-radius layui-btn-normal" onclick="search()" >搜索点我</button>
                </div>
            </div>
        </form>
    </div>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col width="200">
                <col width="200">
            </colgroup>
            <thead>
            <tr>
                <th>ID</th>
                <th>菜单名称</th>
                <th>路由</th>
                <th>权限状态</th>
                <th>添加时间</th>
            </tr>
            </thead>
        </table>
        <table id="ajax_return" class="layui-table">
        </table>
    </div>

@endsection

@section('js')
    <script>
        //加载页面就运行
        $(function(){
            get_table_ajax('forms');
        });
        function search(){
            get_table_ajax('forms');
        };

        function get_table_ajax(forms) {
            $.ajax({
                url:"{{ url('admin/accessListAjax') }}",
                type:"get",
                data:$("#"+forms).serialize(),
                success:function(res) {
                    console.log(res);
                    $("#ajax_return").html('');
                    $("#ajax_return").append(res);
                }
            });
        };
    </script>
@endsection
