<!doctype html>
<html lang="en">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
</head>
<body>

<table>
<tr>
    <th>Ten</th>
    <th>Mo ta</th>
</tr>
@foreach($data as $collect)
    <tr>
        <td>{{ $collect['name'] }}</td>
        <td>{{ $collect['description'] }}</td>
    </tr>
@endforeach
</table>

</body>
</html>