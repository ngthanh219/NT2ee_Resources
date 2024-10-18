@extends('admin.app')
@section('index')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    {{ $pageName }}
                </h3>
                <a href="{{ route('orders.create') }}" class="btn btn-primary">Thêm thông tin</a>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <form class="input-group" method="GET" action="{{ route('orders.index') }}">
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
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-sm-2 pl-0">
                            <label class="control-label">Trạng thái đơn hàng</label>
                            <select class="form-control" name="status" onchange="location = this.value;">
                                @foreach ($orderStatusName as $index => $name)
                                    <option
                                        value="{{ route('orders.index', ['status' => $index] + $request->all()) }}"
                                        {{ isset($request->status) && $request->status == $index ? 'selected' : '' }}
                                    >
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <label class="control-label">Trạng thái thanh toán</label>
                            <select class="form-control" name="is_paid" onchange="location = this.value;">
                                @foreach ($isPaidName as $index => $name)
                                    <option
                                        value="{{ route('orders.index', ['is_paid' => $index] + $request->all()) }}"
                                        {{ isset($request->is_paid) && $request->is_paid == $index ? 'selected' : '' }}
                                    >
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive">
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
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                    Hiển thị {{ $orders->firstItem() }} đến {{ $orders->lastItem() }} trong tổng số
                                    {{ $orders->total() }} dữ liệu
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        @foreach ($orders->links()->elements[0] as $key => $item)
                                            @if ($orders->links()->paginator->currentPage() == $key)
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
