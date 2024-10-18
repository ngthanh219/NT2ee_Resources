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
            <div class="col-md-12 col-sm-12">
                <form method="POST" action="{{ route('orders.store') }}" id="demo-form2" class="form-horizontal">
                    @csrf
                    <div class="col-md-4">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Thông tin đơn hàng</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Tài khoản chính *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="form-control" name="user_id" id="select2-users">
                                            <option value="0">--Lựa chọn--</option>
                                            @foreach ($users as $user)
                                                <option
                                                    value="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-phone="{{ $user->phone }}"
                                                    data-address="{{ $user->address }}"
                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}
                                                >
                                                    {{ $user->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <div class="error-text">{{ $errors->first('user_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Tên đầy đủ *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="..." value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <div class="error-text">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Email *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="..." value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <div class="error-text">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Điện thoại *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="..." value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <div class="error-text">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Địa chỉ *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="..." value="{{ old('address') }}">
                                        @if ($errors->has('address'))
                                            <div class="error-text">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Ghi chú</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea name="note" class="form-control">{{ old('note') }}</textarea>
                                        @if ($errors->has('note'))
                                            <div class="error-text">{{ $errors->first('note') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Trạng thái *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="form-control" name="status">
                                            @foreach ($orderStatusName as $index => $name)
                                                <option value="{{ $index }}">
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="error-text">{{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Thanh toán *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="form-control" name="is_paid">
                                            @foreach ($isPaidName as $index => $name)
                                                <option value="{{ $index }}">
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('is_paid'))
                                            <div class="error-text">{{ $errors->first('is_paid') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Thông tin sản phẩm</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="col-md-7">
                                            <label class="control-label">Sản phẩm *</label>
                                            <select class="form-control" id="select2-products">
                                                <option value="0">--Lựa chọn--</option>
                                                @foreach ($products as $product)
                                                    @foreach ($product->prices as $price)
                                                        <option
                                                            value="{{ $price->id }}"
                                                            data-name="{{ $product->name . ' - ' . $price->attribute_names }}"
                                                            data-quantity="{{ $price->quantity }}"
                                                            data-price="{{ $price->sale_price }}"
                                                        >
                                                            {{ $product->name . ' - ' . $price->attribute_names . ': ' . number_format($price->sale_price) }}đ
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="control-label">Số lượng *</label>
                                            <input type="number" class="form-control" id="current-quantity" min="1" value="{{ old('quantity') ?? 1 }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="control-label">Giá *</label>
                                            <input type="text" class="form-control" id="current-product-price-format"
                                                value="0đ" readonly>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="control-label">&nbsp</label>
                                            <a href="#" onclick="addCart(event)"
                                                class="form-control btn btn-primary">Thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="x_content">
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title" width="500px">Sản phẩm</th>
                                                <th class="column-title">Giá bán</th>
                                                <th class="column-title" width="100px">Số lượng</th>
                                                <th class="column-title" width="200px">Thành tiền</th>
                                                <th class="column-title no-link last">
                                                    <span class="nobr">Hành động</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody id="cart">
                                            <tr class="no-data">
                                                <td colspan="5" class="text-center">Không có dữ liệu</td>
                                            </tr>
                                        </tbody>

                                        <tbody id="cart-total"></tbody>
                                    </table>
                                </div>
                            </div>
                            @if ($errors->has('product'))
                                <div class="error-text">{{ $errors->first('product') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="item form-group">
                            <div class="col-md-6 pl-0">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-default">Hủy</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/order.js') }}"></script>
@endsection
