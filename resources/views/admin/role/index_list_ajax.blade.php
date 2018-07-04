<colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col width="200">
</colgroup>
<tbody>
    @if(count($lists) < 0)
        <tr>
            <td></td>
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