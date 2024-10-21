<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa đơn số {{ $order->id }}</title>
    <style>
        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        table,
        td,
        th {
            border: 1px solid;
            text-align: left;
            padding: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <p><b>Số</b> {{ $order->id }}</p>
    </div>
    <p><b>Thời gian đặt:</b> {{ date_format($order->created_at, 'd-m-Y H:i:s') }}</p>
    <p><b>Khách hàng:</b> {{ $order->name }}</p>
    <p><b>Số điện thoại:</b> {{ $order->phone }}</p>
    <p><b>Địa chỉ nhận hàng:</b> {{ $order->address }}</p>
    <p><b class="text-uppercase">ghi chú</b>: {{ $order->note }}</p>
    <table>
        <tr>
            <th>TT</th>
            <th>Sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        @php
            $quantityTotal = 0;
        @endphp
        @foreach ($order->orderDetails as $index => $orderDetail)
            @php
                $quantityTotal += $orderDetail->quantity;
            @endphp
            <tr>
                <td>{{ $index += 1 }}</td>
                <td>{{ $orderDetail->product_name }}</td>
                <td>{{ number_format($orderDetail->product_price) }}đ</td>
                <td>{{ $orderDetail->quantity }}</td>
                <td>{{ number_format($orderDetail->total) }}đ</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">
                <b>Tổng giá trị đơn hàng:</b>
            </td>
            <td>{{ $quantityTotal }}</td>
            <td>{{ number_format($order->total) }}đ</td>
        </tr>
    </table>
</body>

</html>

<script>
    window.print();
</script>