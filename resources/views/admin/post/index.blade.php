@extends('admin.app')
@section('index')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    {{ $pageName }}
                </h3>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Thêm thông tin</a>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    @include('admin.post.search')
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        @include('admin.post.filter')
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="table-responsive">
                            @include('admin.post.table')
                        </div>
                        @include('admin.post.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
