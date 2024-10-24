<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">ID</th>
            <th class="column-title">Phân loại</th>
            <th class="column-title">Loại sản phẩm</th>
            <th class="column-title">Mô tả</th>
            <th class="column-title no-link last">
                <span class="nobr">Hành động</span>
            </th>
        </tr>
    </thead>

    @if (count($attributes))
        <tbody>
            @foreach ($attributes as $attribute)
                <tr class="even pointer">
                    <td>{{ $attribute->id }}</td>
                    <td>{{ config('base.attribute_type_name')[$attribute->type] }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td>{{ $attribute->description }}</td>
                    <td>
                        <a href="{{ route('attributes.edit', $attribute->id) }}"
                            class="btn btn-primary btn-sm">
                            Chỉnh sửa
                        </a>
                        <form action="{{ route('attributes.destroy', $attribute->id) }}" method="POST">
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