<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">ID</th>
            <th class="column-title">Hình ảnh</th>
            <th class="column-title">Tên bài viết</th>
            <th class="column-title">Trạng thái hiển thị</th>
            <th class="column-title no-link last">
                <span class="nobr">Hành động</span>
            </th>
        </tr>
    </thead>

    @if (count($posts))
        <tbody>
            @foreach ($posts as $post)
                <tr class="even pointer">
                    <td>{{ $post->id }}</td>
                    <td>
                        <img class="table-img" src="{{ asset('images/' . $post->image) }}" alt="">
                    </td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->view_name }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="btn btn-primary btn-sm">
                            Chỉnh sửa
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
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