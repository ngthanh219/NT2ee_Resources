@extends('admin.app')
@section('index')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    {{ $pageName }}
                </h3>
                <a href="{{ route('attributes.create') }}" class="btn btn-primary">Thêm thông tin</a>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <form class="input-group" method="GET" action="{{ route('attributes.index') }}">
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
                            <label class="control-label">Loại</label>
                            <select class="form-control" onchange="location = this.value;">
                                @foreach (config('base.attribute_type_name') as $key => $item)
                                    <option
                                        value="{{ route('attributes.index', ['type' => $key] + $request->all()) }}"
                                        {{ isset($request->type) && $request->type == $key ? 'selected' : '' }}>
                                        {{ $item }}
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
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                    Hiển thị {{ $attributes->firstItem() }} đến {{ $attributes->lastItem() }} trong tổng số
                                    {{ $attributes->total() }} dữ liệu
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        @foreach ($attributes->links()->elements[0] as $key => $item)
                                            @if ($attributes->links()->paginator->currentPage() == $key)
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
