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
                        <form method="POST" action="{{ route('users.store') }}" id="demo-form2" class="form-horizontal">
                            @csrf
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Tên đầy đủ *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="name" placeholder="..." value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <div class="error-text">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Loại tài khoản *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" name="role_id">
                                        <option value="{{ config('base.role_id.admin') }}" {{ old('role_id') == config('base.role_id.admin') ? 'selected' : '' }}>Admin</option>
                                        {{-- <option value="{{ config('base.role_id.manage') }}" {{ old('role_id') == config('base.role_id.manage') ? 'selected' : '' }}>Quản lý</option>
                                        <option value="{{ config('base.role_id.staff') }}" {{ old('role_id') == config('base.role_id.staff') ? 'selected' : '' }}>Nhân viên</option> --}}
                                        <option value="{{ config('base.role_id.customer') }}" {{ old('role_id') == config('base.role_id.customer') ? 'selected' : '' }}>Khách hàng</option>
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <div class="error-text">{{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Email *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="email" class="form-control" name="email" placeholder="..." value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <div class="error-text">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Mật khẩu *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="password" class="form-control" name="password" placeholder="***" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                        <div class="error-text">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Điện thoại</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="phone" placeholder="..." value="{{ old('phone') }}">
                                    @if ($errors->has('phone'))
                                        <div class="error-text">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Địa chỉ</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="address" placeholder="..." value="{{ old('address') }}">
                                    @if ($errors->has('address'))
                                        <div class="error-text">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-default">Hủy</a>
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
