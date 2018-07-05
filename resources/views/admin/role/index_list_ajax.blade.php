<colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col width="200">
</colgroup>
<tbody>
    @if(count($lists) <= 0)
        <tr>
            <td align="center" axis="col0" colspan="50">
                <div class="layui-progress layui-progress-big" lay-showPercent="true">
                    <div class="layui-progress-bar layui-bg-blue" lay-percent="80%"></div>
                </div>
            </td>
        </tr>
    @else
        @foreach($lists as $list)
            <tr>
                <td>{{ $list['role_id'] }}</td>
                <td>{{ $list['role_name'] }}</td>
                <td>{{ $list['role_status'] }}</td>
                <td>{{ $list['role_updatetime'] }}</td>
            </tr>
        @endforeach
    @endif
</tbody>