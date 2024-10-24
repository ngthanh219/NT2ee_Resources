<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">ID</th>
            <th class="column-title">Địa chỉ</th>
            <th class="column-title">Điện thoại</th>
            <th class="column-title">Email</th>
            <th class="column-title">Trạng thái hiển thị</th>
            <th class="column-title no-link last">
                <span class="nobr">Hành động</span>
            </th>
        </tr>
    </thead>

    @if (count($stores))
        <tbody>
            @foreach ($stores as $store)
                <tr class="even pointer">
                    <td>{{ $store->id }}</td>
                    <td>{{ $store->address }}</td>
                    <td>{{ $store->phone }}</td>
                    <td>{{ $store->email }}</td>
                    <td>{{ $store->view_name }}</td>
                    <td>
                        <a href="{{ route('stores.edit', $store->id) }}"
                            class="btn btn-primary btn-sm">
                            Chỉnh sửa
                        </a>
                        @if (config('base.env.multi_store'))
                            <a href="{{ route('stores.show', $store->id) }}"
                                class="btn btn-warning btn-sm">
                                Kho sản phẩm
                            </a>
                        @endif
                        <form action="{{ route('stores.destroy', $store->id) }}" method="POST">
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
                <td colspan="6" class="text-center">Không có dữ liệu</td>
            </tr>
        </tbody>
    @endif
</table>