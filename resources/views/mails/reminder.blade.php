<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nhắc nhở nạp sản phẩm</title>
</head>
<body>
    <p class="lead">Chào <b>{{ $supplier->name }}</b>,</p>

    <p>Hiện tại đại lý <b>{{ $distributor->name }}</b>, mâm <b>{{ $tray->name }}</b> của tủ <b>{{ $cabinet->name }}</b> sắp hết sản phẩm.</p>
    <p>Vui lòng sắp xếp nhân viên đến nạp sản phẩm.</p>

    <p>Cám ơn!</p>

    <p>Thông tin chi tiết của <b>{{ $cabinet->name }}</b></p>
    <table>
        <tr>
            <th>Mâm</th>
            <th>Mã vạch sản phẩm</th>
            <th>Sản phẩm</th>
            <th>ĐVT</th>
            <th>Đơn giá</th>
            <th>Còn lại</th>
        </tr>
        @foreach($tray_products as $item)
        <tr>
            <td>{{ $item->tray_name  }}</td>
            <td>{{ $item->product_barcode  }}</td>
            <td>{{ $item->product_name  }}</td>
            <td>{{ $item->unit_name  }}</td>
            <td>{{ $item->fc_price_input  }}</td>
            <td>{{ $item->total_quantum  }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>