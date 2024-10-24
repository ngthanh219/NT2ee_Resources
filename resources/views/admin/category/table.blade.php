<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">ID</th>
            <th class="column-title">Tên danh mục</th>
            <th class="column-title">Trạng thái hiển thị</th>
            <th class="column-title no-link last">
                <span class="nobr">Hành động</span>
            </th>
        </tr>
    </thead>

    @if (count($categories))
        <tbody>
            @foreach ($categories as $category)
                <tr class="even pointer">
                    <td>{{ $category->id }}</td>
                    <td>
                        {{ $category->name }}
                        @if ($category->children_count > 0)
                            <br>
                            <small>{{ $category->children_count }} danh mục con</small>
                        @endif
                    </td>
                    <td>{{ $category->view_name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}"
                            class="btn btn-primary btn-sm">
                            Chỉnh sửa
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}"
                            method="POST">
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