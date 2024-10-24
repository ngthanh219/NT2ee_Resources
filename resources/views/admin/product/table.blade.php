<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">ID</th>
            <th class="column-title">Hình ảnh</th>
            <th class="column-title">Sản phẩm</th>
            <th class="column-title">Trạng thái hiển thị</th>
            <th class="column-title">Trạng thái mới</th>
            <th class="column-title">Trạng thái nổi bật</th>
            <th class="column-title">Trạng thái bán chạy</th>
            <th class="column-title no-link last">
                <span class="nobr">Hành động</span>
            </th>
        </tr>
    </thead>

    @if (count($products))
        <tbody>
            @foreach ($products as $product)
                <tr class="even pointer">
                    <td>{{ $product->id }}</td>
                    <td>
                        <img class="table-img" src="{{ asset('images/' . $product->image[0]) }}" alt="">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->view_name }}</td>
                    <td>{{ $product->is_new_name }}</td>
                    <td>{{ $product->is_hot_name }}</td>
                    <td>{{ $product->is_best_seller_name }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="btn btn-primary btn-sm">
                            Chỉnh sửa
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
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