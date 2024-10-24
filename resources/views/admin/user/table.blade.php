<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">ID</th>
            <th class="column-title">Tên đầy đủ</th>
            <th class="column-title">Email</th>
            <th class="column-title">Loại tài khoản</th>
            <th class="column-title">Số điện thoại</th>
            <th class="column-title no-link last">
                <span class="nobr">Hành động</span>
            </th>
        </tr>
    </thead>

    @if (count($users))
        <tbody>
            @foreach ($users as $user)
                <tr class="even pointer">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role_name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="btn btn-primary btn-sm">
                            Chỉnh sửa
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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