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
                    @include('admin.common.search', ['route' => 'categories.index'])
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        @include('admin.category.filter')
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive">
                            @include('admin.category.table')
                        </div>
                        @include('admin.common.pagination', ['model' => $categories])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
