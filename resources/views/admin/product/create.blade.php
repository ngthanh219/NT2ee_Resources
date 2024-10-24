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
                        <form method="POST" action="{{ route('products.store') }}" id="form" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Danh mục *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="category_id[]" id="select2" multiple
                                        size="{{ count($categories) }}">
                                        @foreach ($categories as $category)
                                            @if ($category->parent_id == 0)
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach ($category->children as $child)
                                                        <option value="{{ $child->id }}"
                                                            {{ old('category_id') && in_array($child->id, old('category_id')) ? 'selected' : '' }}>
                                                            {{ $child->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="error-text">{{ $errors->first('category_id') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Tên sản phẩm *</label>
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

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Trạng thái mới *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="is_new">
                                        @foreach ($isNewName as $index => $name)
                                            <option value="{{ $index }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('is_new'))
                                        <div class="error-text">{{ $errors->first('is_new') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Trạng thái nổi bật *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="is_hot">
                                        @foreach ($isHotName as $index => $name)
                                            <option value="{{ $index }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('is_hot'))
                                        <div class="error-text">{{ $errors->first('is_hot') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Trạng thái bán chạy *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="is_best_seller">
                                        @foreach ($isBestSellerName as $index => $name)
                                            <option value="{{ $index }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('is_best_seller'))
                                        <div class="error-text">{{ $errors->first('is_best_seller') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Hình ảnh *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="file" class="form-control" name="image[]" multiple>
                                    @if ($errors->has('image'))
                                        <div class="error-text">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Mô tả *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div id="editor">
                                        {!! old('description') !!}
                                    </div>
                                    <input type="hidden" name="description" id="description" required>
                                    @if ($errors->has('description'))
                                        <div class="error-text">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-default">Hủy</a>
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
            document.querySelector('#description').value = window.editor.getData();
            this.submit();
        });
    </script>
@endsection
