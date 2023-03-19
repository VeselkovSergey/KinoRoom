<table>
    <thead>
    <tr>
        <th>id</th>
        <th>IP</th>
        <th>data</th>
        <th>created at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($analytics as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->client_ip_address}}</td>
            <td>{{$item->data}}</td>
            <td>{{$item->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
