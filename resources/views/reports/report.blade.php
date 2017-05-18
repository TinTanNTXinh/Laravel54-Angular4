{{-- Title --}}
<h3>{{$title}}</h3>

{{-- Data --}}
<table class="table table-striped">
    <thead>
    <tr>
        <th>STT</th>
        @foreach($header as $key1_name)
            <th>{{$key1_name}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    {!! $i = 1 !!}
    @foreach($data as $item)
        <tr>
            <td>{{$i++}}</td>
            @foreach($header as $key_name)
                <td>{{ $item[$key_name] }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>