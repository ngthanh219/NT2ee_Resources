@extends('admin.app')
@section('index')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    {{ $pageName }}
                </h3>
                <a href="{{ route('categories.create', isset($request->parent_id) ? ['parent_id' => $request->parent_id] : []) }}"
                    class="btn btn-primary">Thêm thông tin</a>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <form class="input-group" method="GET" action="{{ route('categories.index') }}">
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
                        <div class="col-sm-4 pl-0">
                            <label class="control-label">Danh mục cha</label>
                            <select class="form-control" onchange="location = this.value;">
                                <option
                                    value="{{ route('categories.index', ['parent_id' => config('base.parent_category_default')] + $request->all()) }}">
                                    Tất cả
                                </option>

                                @foreach ($parentCategories as $parentCategory)
                                    <option
                                        value="{{ route('categories.index', ['parent_id' => $parentCategory->id] + $request->all()) }}"
                                        {{ isset($request->parent_id) && $request->parent_id == $parentCategory->id ? 'selected' : '' }}>
                                        {{ $parentCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label">Trạng thái hiển thị</label>
                            <select class="form-control" onchange="location = this.value;">
                                <option
                                    value="{{ route('categories.index', ['view' => config('base.view.all')] + $request->all()) }}">
                                    Tất cả
                                </option>
                                <option
                                    value="{{ route('categories.index', ['view' => config('base.view.show')] + $request->all()) }}"
                                    {{ isset($request->view) && $request->view == config('base.view.show') ? 'selected' : '' }}>
                                    Đang hiển thị
                                </option>
                                <option
                                    value="{{ route('categories.index', ['view' => config('base.view.hidden')] + $request->all()) }}"
                                    {{ isset($request->view) && $request->view == config('base.view.hidden') ? 'selected' : '' }}>
                                    Đang ẩn
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
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                    Hiển thị {{ $categories->firstItem() }} đến {{ $categories->lastItem() }} trong tổng
                                    số {{ $categories->total() }} dữ liệu
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        @foreach ($categories->links()->elements[0] as $key => $item)
                                            @if ($categories->links()->paginator->currentPage() == $key)
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
