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
                        <form method="POST" action="{{ route('categories.store') }}" id="demo-form2" class="form-horizontal">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Danh mục cha *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="parent_id">
                                        <option value="{{ config('base.parent_category_default') }}">-- Không có --</option>
                                        @foreach ($parentCategories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}"
                                                {{ old('parent_id') == $parentCategory->id ? 'selected' : '' }}>
                                                {{ $parentCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('parent_id'))
                                        <div class="error-text">{{ $errors->first('parent_id') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Tên danh mục *</label>
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

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-default">Hủy</a>
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
@endsection
