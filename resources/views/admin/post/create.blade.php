@extends('admin.app')
@section('index')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    {{ $pageName }}
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form method="POST" action="{{ route('posts.store') }}" id="form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Tên bài viết *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="name" placeholder="..."
                                        value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <div class="error-text">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Trạng thái hiển thị *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="view">
                                        <option value="{{ config('base.view.show') }}"
                                            {{ old('view') == config('base.view.show') ? 'selected' : '' }}>Hiển thị
                                        </option>
                                        <option value="{{ config('base.view.hidden') }}"
                                            {{ old('view') == config('base.view.hidden') ? 'selected' : '' }}>Ẩn</option>
                                    </select>
                                    @if ($errors->has('view'))
                                        <div class="error-text">{{ $errors->first('view') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Hình ảnh *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="file" class="form-control" name="image">
                                    @if ($errors->has('image'))
                                        <div class="error-text">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Mô tả ngắn *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="short_description" placeholder="..."
                                        value="{{ old('short_description') }}">
                                    @if ($errors->has('short_description'))
                                        <div class="error-text">{{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Nội dung *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div id="editor">
                                        {!! old('content') !!}
                                    </div>
                                    <input type="hidden" name="content" id="content" required>
                                    @if ($errors->has('content'))
                                        <div class="error-text">{{ $errors->first('content') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route('posts.index') }}" class="btn btn-default">Hủy</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.querySelector('#content').value = window.editor.getData();
            this.submit();
        });
    </script>
@endsection
