<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">Mã đơn hàng</th>
            <th class="column-title">Giá trị đơn hàng</th>
            <th class="column-title">Tên đầy đủ</th>
            <th class="column-title">Điện thoại</th>
            <th class="column-title">Địa chỉ</th>
            <th class="column-title">Trạng thái đơn hàng</th>
            <th class="column-title">Trạng thái thanh toán</th>
            <th class="column-title no-link last">
                <span class="nobr">Hành động</span>
            </th>
        </tr>
    </thead>

    @if (count($orders))
        <tbody>
            @foreach ($orders as $order)
                <tr class="even pointer">
                    <td>#{{ $order->id }}</td>
                    <td>{{ number_format($order->total) }}đ</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->status_name }}</td>
                    <td>{{ $order->is_paid_name }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}"
                            class="btn btn-primary btn-sm">
                            Chỉnh sửa
                        </a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                onClick="return confirm('Bạn có chắc chắn muốn xóa')">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @else
        <tbody>
            <tr>
                <td colspan="8" class="text-center">Không có dữ liệu</td>
            </tr>
        </tbody>
    @endif
</table>