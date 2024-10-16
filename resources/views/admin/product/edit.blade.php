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
                        <h2>Thông tin sản phẩm</h2>
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
                                            <input type="hidden" name="current_image[{{ $index }}]"
                                                value="{{ $image }}">
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
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Chỉnh sửa loại sản phẩm</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form method="POST"
                            action="{{ isset($request->product_price_id)
                                ? route('products.prices.update', [$product->id, $request->product_price_id])
                                : route('products.prices.store', $product->id) }}"
                            id="form" class="form-horizontal">
                            @csrf

                            @if (isset($request->product_price_id))
                                @method('PUT')
                            @endif

                            @foreach ($attributes as $attribute)
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">{{ $attribute['name'] }} *</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <select class="form-control" name="attribute_ids[]">
                                            @foreach ($attribute['data'] as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ isset($request->product_price_id) && in_array($item['id'], $productPrice->attribute_ids) ? 'selected' : '' }}>
                                                    {{ $item['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Số lượng *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" name="quantity"
                                        value="{{ isset($request->product_price_id) ? $productPrice->quantity : old('quantity') ?? 0 }}"
                                        min="0">
                                    @if ($errors->has('quantity'))
                                        <div class="error-text">{{ $errors->first('quantity') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">
                                    Giá gốc
                                    (<span id="price-format">0</span>
                                    <sup>đ</sup>) *
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ isset($request->product_price_id) ? $productPrice->price : old('price') ?? 0 }}"
                                        min="0" max="100000000">
                                    @if ($errors->has('price'))
                                        <div class="error-text">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Khuyến mãi *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" id="sale-percent" name="sale_percent"
                                        value="{{ isset($request->product_price_id) ? $productPrice->sale_percent : old('sale_percent') ?? 0 }}"
                                        min="0">
                                    @if ($errors->has('sale_percent'))
                                        <div class="error-text">{{ $errors->first('sale_percent') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">
                                    Giá bán
                                    (<span id="sale-price-format">0</span>
                                    <sup>đ</sup>) *
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" id="sale-price" name="sale_price"
                                        value="{{ isset($request->product_price_id) ? $productPrice->sale_price : old('sale_price') ?? 0 }}"
                                        min="0" max="100000000">
                                    @if ($errors->has('sale_price'))
                                        <div class="error-text">{{ $errors->first('sale_price') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">
                                        {{ isset($request->product_price_id) ? 'Cập nhật' : 'Thêm' }}
                                    </button>
                                    @if (isset($request->product_price_id))
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-default">Hủy</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">STT</th>
                                        <th class="column-title">Loại sản phẩm</th>
                                        <th class="column-title">Số lượng</th>
                                        <th class="column-title">Giá gốc</th>
                                        <th class="column-title">Khuyến mãi</th>
                                        <th class="column-title">Giá bán</th>
                                        <th class="column-title no-link last">
                                            <span class="nobr">Hành động</span>
                                        </th>
                                    </tr>
                                </thead>

                                @if (count($productPrices))
                                    <tbody>
                                        @foreach ($productPrices as $index => $price)
                                            <tr class="even pointer">
                                                <td>{{ $index += 1 }}</td>
                                                <td>{{ $price->attribute_names }}</td>
                                                <td>{{ $price->quantity }}</td>
                                                <td>{{ number_format($price->price) }}<sup>đ</sup></td>
                                                <td>{{ number_format($price->sale_percent) }}<sup>%</sup></td>
                                                <td>{{ number_format($price->sale_price) }}<sup>đ</sup></td>
                                                <td>
                                                    <a href="{{ route('products.edit', [$product->id, 'product_price_id' => $price->id]) }}"
                                                        class="btn btn-primary btn-sm">
                                                        Chỉnh sửa
                                                    </a>
                                                    <form
                                                        action="{{ route('products.prices.destroy', [$product->id, $price->id]) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onClick="return confirm('Bạn có chắc chắn muốn xóa')">
                                                            Xóa
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <tbody>
                                        <tr>
                                            <td colspan="7" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>
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

        window.onload = function() {
            var priceInput = document.getElementById('price');
            var salePercentInput = document.getElementById('sale-percent');
            var salePriceInput = document.getElementById('sale-price');
            var priceFormatDiv = document.getElementById('price-format');
            var salePriceFormatDiv = document.getElementById('sale-price-format');

            function calculateSalePrice() {
                var price = parseFloat(priceInput.value);
                var salePercent = parseFloat(salePercentInput.value);

                if (!isNaN(price)) {
                    priceFormatDiv.textContent = price.toLocaleString('vi-VN');
                }

                if (!isNaN(price) && !isNaN(salePercent)) {
                    var salePrice = price - (price * salePercent / 100);
                    salePriceInput.value = salePrice;
                    salePriceFormatDiv.textContent = salePrice.toLocaleString('vi-VN');
                }
            }

            function filterSalePrice() {
                var salePrice = parseFloat(salePriceInput.value);

                if (!isNaN(salePrice)) {
                    salePriceFormatDiv.textContent = salePrice.toLocaleString('vi-VN');
                }
            }

            priceInput.addEventListener('input', calculateSalePrice);
            salePercentInput.addEventListener('input', calculateSalePrice);
            salePriceInput.addEventListener('input', filterSalePrice);
        };
    </script>
@endsection
