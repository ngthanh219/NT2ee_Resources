@extends('admin.app')
@section('index')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    {{ $pageName }}
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <form class="input-group" method="GET" action="{{ route('stores.show', $store->id) }}">
                        @foreach ($request->all() as $key => $item)
                            @if ($key != 'key')
                                <input type="hidden" name="{{ $key }}" value="{{ $item }}">
                            @endif
                        @endforeach
                        <input type="text" name="key" class="form-control" placeholder="Tìm kiếm tên sản phẩm..."
                            value="{{ isset($request->key) ? $request->key : '' }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Lọc</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">STT</th>
                                        <th class="column-title">Sản phẩm</th>
                                        <th class="column-title" width="200px">SL trong chi nhánh</th>
                                        <th class="column-title">SL trong kho</th>
                                        <th class="column-title">SL yêu cầu</th>
                                        <th class="column-title no-link last">
                                            <span class="nobr">Hành động</span>
                                        </th>
                                    </tr>
                                </thead>

                                @if (count($productPrices))
                                    <tbody>
                                        @foreach ($productPrices as $index => $productPrice)
                                            <form
                                                action="{{ route('stores.supply.product', $store->id) }}"
                                                method="POST"
                                                id="form"
                                            >
                                                @csrf
                                                <input type="hidden" name="type" id="type-{{ $productPrice->id }}">
                                                <input type="hidden" name="product_price_id" value="{{ $productPrice->id }}">
                                                <tr class="even pointer">
                                                    <td>{{ $index += 1 }}</td>
                                                    <td>{{ '#' . $productPrice->id . ': ' . $productPrice->product->name . ' (' . $productPrice->attribute_names }})
                                                    </td>
                                                    <td>
                                                        {{ $productPrice->inventory ? $productPrice->inventory->quantity : 0 }}
                                                    </td>
                                                    <td>
                                                        {{ $productPrice->quantity }}
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            class="form-control"
                                                            name="quantity"
                                                            min="0"
                                                            value="{{ old('quantity') ? (old('product_price_id') == $productPrice->id ? old('quantity') : 0) :  0 }}"
                                                        />
                                                        @if ($errors->has('quantity') && old('product_price_id') == $productPrice->id)
                                                            <div class="error-text">{{ $errors->first('quantity') }}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-primary btn-sm" onclick="submitForm('import', {{ $productPrice->id }})">
                                                            Nhập SP vào chi nhánh
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm" onclick="submitForm('export', {{ $productPrice->id }})">
                                                            Xuất SP về kho
                                                        </button>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody>
                                @else
                                    <tbody>
                                        <tr>
                                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                                    Hiển thị {{ $productPrices->firstItem() }} đến {{ $productPrices->lastItem() }} trong
                                    tổng số
                                    {{ $productPrices->total() }} dữ liệu
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    <ul class="pagination">
                                        @foreach ($productPrices->links()->elements[0] as $key => $item)
                                            @if ($productPrices->links()->paginator->currentPage() == $key)
                                                <li class="active">
                                                    <a>{{ $key }}</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $item }}">{{ $key }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function submitForm(type, productPriceId) {
            var typeValue = type === 'import' ? "{{ config('base.supply_type.import') }}" : "{{ config('base.supply_type.export') }}";
            document.getElementById('type-' + productPriceId).value = typeValue;
            document.getElementById('form').submit();
        }
    </script>
@endsection
