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
                <form method="POST" action="{{ route('stores.store') }}" id="demo-form2" class="form-horizontal">
                    @csrf
                    <div class="col-md-3">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Thông tin đơn hàng</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Chủ sở hữu *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="form-control" name="user_id" id="select2-users">
                                            <option value="0">--Lựa chọn--</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}" data-phone="{{ $user->phone }}"
                                                    data-address="{{ $user->address }}">
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <div class="error-text">{{ $errors->first('user_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Họ & tên *</label>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
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
                                            {{-- <input type="hidden" id="current-product-price-id">
                                            <input type="hidden" id="current-product-name">
                                            <input type="hidden" id="current-product-price">
                                            <input type="hidden" id="current-product-quantity"> --}}
                                            
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
                                                <th class="column-title">Sản phẩm</th>
                                                <th class="column-title">Giá bán</th>
                                                <th class="column-title">Số lượng</th>
                                                <th class="column-title">Thành tiền</th>
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="item form-group">
                            <div class="col-md-6 pl-0">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{ route('stores.index') }}" class="btn btn-default">Hủy</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var selectedProductPriceId = '';
        var selectedName = '';
        var selectedQuantityLimit = '';
        var selectedPrice = '';
        var currentQuantity = 1;

        $(document).ready(function() {
            $('#select2-users').select2({
                placeholder: "Select options",
                allowClear: true
            }).on("select2:select", function(e) {
                var selectedOption = $(this).find(':selected');
                var userName = selectedOption.data('name');
                var userEmail = selectedOption.data('email');
                var userPhone = selectedOption.data('phone');
                var userAddress = selectedOption.data('address');

                document.getElementById('name').value = userName;
                document.getElementById('email').value = userEmail;
                document.getElementById('phone').value = userPhone;
                document.getElementById('address').value = userAddress;
            });

            $('#select2-products').select2({
                placeholder: "Select options",
                allowClear: true
            }).on("select2:select", function(e) {
                var selectedOption = $(this).find(':selected');
                selectedProductPriceId = e.params.data.id;
                selectedName = selectedOption.data('name');
                selectedQuantityLimit = selectedOption.data('quantity');
                selectedPrice = selectedOption.data('price');
                document.getElementById('current-quantity').value = 1;
                currentQuantity = 1;

                // console.log(selectedProductPriceId);
                // console.log(selectedName);
                // console.log(selectedQuantityLimit);
                // console.log(selectedPrice);
                document.getElementById('current-product-price-format').value = selectedPrice.toLocaleString('vi-VN') + 'đ';
            });
        });

        function addCart(e) {
            e.preventDefault();

            if (!selectedProductPriceId) {
                alert('Cần chọn sản phẩm');
            } else {
                var cartEle = document.getElementById('cart');
                var noData = cartEle.querySelector('.no-data');
                var currentQuantityEle = document.getElementById('current-quantity');
                currentQuantity = currentQuantityEle.value;
                var data = `
                    <tr class="even pointer" id="cart-item-${selectedProductPriceId}">
                        <td>${selectedName}</td>
                        <td>${(selectedPrice).toLocaleString('vi-VN') + 'đ'}</td>
                        <td width="100px">
                            <input type="number" min="0" max="${selectedQuantityLimit}" class="form-control" id="cart-item-${selectedProductPriceId}-quantity" value="${currentQuantity}" />
                        </td>
                        <td id="cart-item-${selectedProductPriceId}-total">
                            ${(parseInt(selectedPrice) * parseInt(currentQuantity)).toLocaleString('vi-VN') + 'đ'}
                        </td>
                        <td>
                            <a href="#" onclick="deleteItem(event, ${selectedProductPriceId})" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                `;

                if (noData) {
                    cartEle.innerHTML = data;
                } else {
                    var existItem = cartEle.querySelector('#cart-item-' + selectedProductPriceId);

                    if (existItem) {
                        var cartItemQuantity = document.getElementById('cart-item-' + selectedProductPriceId + '-quantity');
                        var updatedCartItemQuantity = parseInt(cartItemQuantity.value) + parseInt(currentQuantity);

                        if (updatedCartItemQuantity > selectedQuantityLimit) {
                            alert('Sản phẩm không đủ số lượng')
                        } else {
                            cartItemQuantity.value = updatedCartItemQuantity;
                            var cartItemTotal = document.getElementById('cart-item-' + selectedProductPriceId + '-total');
                            cartItemTotal.innerHTML = (parseInt(selectedPrice) * updatedCartItemQuantity).toLocaleString('vi-VN') + 'đ';
                        }
                    } else {
                        cartEle.innerHTML += data;
                    }
                }
            }
        }

        function deleteItem(e, productPriceId) {
            e.preventDefault();

            document.getElementById('cart-item-' + productPriceId).remove();
            var cartEle = document.getElementById('cart');
            var hasTD = cartEle.querySelector('td');

            if (!hasTD) {
                cartEle.innerHTML = `
                    <tr class="no-data">
                        <td colspan="5" class="text-center">Không có dữ liệu</td>
                    </tr>
                `;
            }
        }
    </script>
@endsection
