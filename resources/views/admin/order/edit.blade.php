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
                <form method="POST" action="{{ route('orders.update', $order->id) }}" id="demo-form2" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Thông tin đơn hàng #{{ $order->id }}</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Tài khoản chính</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" value="{{ $order->user->email }}" class="form-control"
                                            readonly>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Tên đầy đủ *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="..." value="{{ $order->name }}">
                                        @if ($errors->has('name'))
                                            <div class="error-text">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Email *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="..." value="{{ $order->email }}">
                                        @if ($errors->has('email'))
                                            <div class="error-text">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Điện thoại *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="..." value="{{ $order->phone }}">
                                        @if ($errors->has('phone'))
                                            <div class="error-text">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Địa chỉ *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="..." value="{{ $order->address }}">
                                        @if ($errors->has('address'))
                                            <div class="error-text">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Ghi chú</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea name="note" class="form-control">{{ $order->note }}</textarea>
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
                                                <option value="{{ $index }}"
                                                    {{ $order->status == $index ? 'selected' : '' }}>
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
                                    <label class="control-label col-md-3 col-sm-3 ">Phương thức thanh toán</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" value="{{ $order->payment_method_name }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Thanh toán *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="form-control" name="is_paid">
                                            @foreach ($isPaidName as $index => $name)
                                                <option value="{{ $index }}"
                                                    {{ $order->is_paid == $index ? 'selected' : '' }}>
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
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title" width="500px">Sản phẩm</th>
                                                @if (config('base.env.multi_store'))
                                                    <th class="column-title" width="500px">Chi nhánh</th>
                                                @endif
                                                <th class="column-title">Giá bán</th>
                                                <th class="column-title" width="100px">Số lượng</th>
                                                <th class="column-title" width="200px">Thành tiền</th>
                                            </tr>
                                        </thead>

                                        <tbody id="cart">
                                            @foreach ($order->orderDetails as $orderDetail)
                                                <tr id="cart-item-{{ $orderDetail->product_price_id }}" data-price="{{ $orderDetail->product_price }}">
                                                    <td>{{ $orderDetail->product_name }}</td>
                                                    @if (config('base.env.multi_store'))
                                                        <td>{{ $orderDetail->store->address ?? 'Kho tổng' }}</td>
                                                    @endif
                                                    <td>{{ number_format($orderDetail->product_price) }}đ</td>
                                                    <td>
                                                        {{ $orderDetail->quantity }}
                                                    </td>
                                                    <td id="cart-item-{{ $orderDetail->product_price_id }}-total">
                                                        {{ number_format($orderDetail->total) }}đ
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tbody id="cart-total">
                                            <tr>
                                                <td colspan="5" class="text-right">
                                                    Tổng giá trị:
                                                    <b>{{ number_format($order->total) }}đ</b>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <a href="{{ route('orders.billing', $order->id) }}" target="_blank"
                                        class="btn btn-primary">
                                        In hóa đơn
                                    </a>
                                </div>
                            </div>
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
