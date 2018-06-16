<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            <li class="layui-nav-item"><a href="{{url('admin/index')}}">console</a></li>
            {{--layui-nav-itemed--}}
            <li class="layui-nav-item">
                <a class="" href="javascript:;">管理员</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/list')}}">管理员列表</a></dd>
                    <dd><a href="javascript:;">角色列表</a></dd>
                    <dd><a href="javascript:;">权限列表</a></dd>
                    <dd><a href="javascript:;">操作日志</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">文章管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/article/create')}}">添加文章</a></dd>
                    <dd><a href="javascript:;">文章列表</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">分类管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/type/create')}}">添加文章分类</a></dd>
                    <dd><a href="{{url('admin/type')}}">分类显示</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="{{url('admin/map')}}">百度api测试</a></li>
            <li class="layui-nav-item"><a href="">发布商品</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">新闻推荐</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/new/index')}}">查看新闻</a></dd>
                    <dd><a href="{{url('')}}"></a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>