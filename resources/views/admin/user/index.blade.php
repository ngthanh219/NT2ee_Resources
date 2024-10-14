@extends('admin.app')
@section('index')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    {{ $pageName }}
                </h3>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm thông tin</a>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <form class="input-group" method="GET" action="{{ route('users.index') }}">
                        @foreach ($request->all() as $key => $item)
                            @if ($key != 'key')
                                <input type="hidden" name="{{ $key }}" value="{{ $item }}">
                            @endif
                        @endforeach
                        <input type="text" name="key" class="form-control" placeholder="Tìm kiếm ..."
                            value="{{ isset($request->key) ? $request->key : '' }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Lọc</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-sm-2 pl-0">
                            <label class="control-label">Loại tài khoản</label>
                            <select class="form-control" onchange="location = this.value;">
                                <option value="{{ route('users.index', ['role_id' => config('base.role_id.all')] + $request->all()) }}">
                                    Tất cả
                                </option>
                                <option value="{{ route('users.index', ['role_id' => config('base.role_id.admin')] + $request->all()) }}"
                                    {{ isset($request->role_id) && $request->role_id == config('base.role_id.admin') ? 'selected' : '' }}>
                                    Admin
                                </option>
                                <option value="{{ route('users.index', ['role_id' => config('base.role_id.manage')] + $request->all()) }}"
                                    {{ isset($request->role_id) && $request->role_id == config('base.role_id.manage') ? 'selected' : '' }}>
                                    Quản lý
                                </option>
                                <option value="{{ route('users.index', ['role_id' => config('base.role_id.staff')] + $request->all()) }}"
                                    {{ isset($request->role_id) && $request->role_id == config('base.role_id.staff') ? 'selected' : '' }}>
                                    Nhân viên
                                </option>
                                <option value="{{ route('users.index', ['role_id' => config('base.role_id.customer')] + $request->all()) }}"
                                    {{ isset($request->role_id) && $request->role_id == config('base.role_id.customer') ? 'selected' : '' }}>
                                    Khách hàng
                                </option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive">
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
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                    Hiển thị {{ $users->firstItem() }} đến {{ $users->lastItem() }} trong tổng số
                                    {{ $users->total() }} dữ liệu
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        @foreach ($users->links()->elements[0] as $key => $item)
                                            @if ($users->links()->paginator->currentPage() == $key)
                                                <li class="active">
                                                    <a>{{ $key }}</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $item }}">{{ $key }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
