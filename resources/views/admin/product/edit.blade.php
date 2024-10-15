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
                        <form method="POST" action="{{ route('products.update', $product->id) }}" id="form"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Danh mục *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select id="category_id" class="form-control" name="category_id[]" multiple
                                        size="{{ count($categories) }}">
                                        @foreach ($categories as $category)
                                            @if ($category->parent_id == 0)
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach ($category->children as $child)
                                                        <option value="{{ $child->id }}"
                                                            {{ in_array($child->id, $productCategories) ? 'selected' : '' }}>
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
                                        value="{{ $product->name }}">
                                    @if ($errors->has('name'))
                                        <div class="error-text">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Slug</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" readonly value="{{ $product->slug }}">
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
                                            {{ $product->view == config('base.view.show') ? 'selected' : '' }}>Hiển thị
                                        </option>
                                        <option value="{{ config('base.view.hidden') }}"
                                            {{ $product->view == config('base.view.hidden') ? 'selected' : '' }}>Ẩn
                                        </option>
                                    </select>
                                    @if ($errors->has('view'))
                                        <div class="error-text">{{ $errors->first('view') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3">Hình ảnh *</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="file" class="form-control" name="image[]" multiple>
                                    @if ($errors->has('image'))
                                        <div class="error-text">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                                <div class="img-list">
                                    @foreach ($product->image as $index => $image)
                                        <div class="img-item" id="current-image[{{ $image }}]">
                                            <input type="hidden" name="current_image[{{ $index }}]" value="{{ $image }}">
                                            <img src="{{ asset('images/' . $image) }}">
                                            <div class="img-action">
                                                <a href="{{ asset('images/' . $image) }}" target="__blank">Xem</a>
                                                <a onclick="removeImage('{{ $image }}')">Xóa</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Mô tả *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <div id="editor">
                                        {!! $product->description !!}
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

        function removeImage(path) {
            let image = document.getElementById('current-image[' + path + ']');
            image.remove();
        }
    </script>
@endsection
