<colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col width="200">
    <col width="200">
</colgroup>
<tbody>
@if(count($access) < 0)
    <tr>
        <td>没有数据</td>
    </tr>
@else
    @foreach($access as $list)
        <tr>
            <td>{{ $list['access_id'] }}</td>
            <td>{{ $list['access_title'] }}</td>
            <td>{{ $list['access_url'] }}</td>
            <td>{{ $list['access_status'] }}</td>
            <td>{{ $list['access_updatetime'] }}</td>
        </tr>
    @endforeach
@endif
</tbody>