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
                        <form method="POST" action="{{ route('attributes.update', $attribute->id) }}" id="demo-form2" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Phân loại *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="type">
                                        @foreach ($attributeTypes as $key => $item)
                                            <option value="{{ $key }}" {{ $attribute->type == $key ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                        <div class="error-text">{{ $errors->first('type') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Loại sản phẩm *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="name" placeholder="..." value="{{ $attribute->name }}">
                                    @if ($errors->has('name'))
                                        <div class="error-text">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Mô tả</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="description" placeholder="..." value="{{ $attribute->description }}">
                                    @if ($errors->has('description'))
                                        <div class="error-text">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route('attributes.index') }}" class="btn btn-default">Hủy</a>
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
