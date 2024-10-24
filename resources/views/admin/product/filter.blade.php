<div class="col-sm-2 pl-0">
    <label class="control-label">Trạng thái hiển thị</label>
    <select class="form-control" onchange="location = this.value;">
        <option
            value="{{ route('products.index', ['view' => config('base.view.all')] + $request->all()) }}">
            Tất cả
        </option>
        <option
            value="{{ route('products.index', ['view' => config('base.view.show')] + $request->all()) }}"
            {{ isset($request->view) && $request->view == config('base.view.show') ? 'selected' : '' }}>
            Đang hiển thị
        </option>
        <option
            value="{{ route('products.index', ['view' => config('base.view.hidden')] + $request->all()) }}"
            {{ isset($request->view) && $request->view == config('base.view.hidden') ? 'selected' : '' }}>
            Đang ẩn
        </option>
    </select>
</div>
<div class="col-sm-2 pl-0">
    <label class="control-label">Trạng thái mới</label>
    <select class="form-control" name="is_new" onchange="location = this.value;">
        @foreach ($isNewName as $index => $name)
            <option
                value="{{ route('products.index', ['is_new' => $index] + $request->all()) }}"
                {{ isset($request->is_new) && $request->is_new == $index ? 'selected' : '' }}
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
<div class="col-sm-2 pl-0">
    <label class="control-label">Trạng thái nổi bật</label>
    <select class="form-control" name="is_hot" onchange="location = this.value;">
        @foreach ($isHotName as $index => $name)
            <option
                value="{{ route('products.index', ['is_hot' => $index] + $request->all()) }}"
                {{ isset($request->is_hot) && $request->is_hot == $index ? 'selected' : '' }}
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
<div class="col-sm-2 pl-0">
    <label class="control-label">Trạng thái bán chạy</label>
    <select class="form-control" name="is_best_seller" onchange="location = this.value;">
        @foreach ($isBestSellerName as $index => $name)
            <option
                value="{{ route('products.index', ['is_best_seller' => $index] + $request->all()) }}"
                {{ isset($request->is_best_seller) && $request->is_best_seller == $index ? 'selected' : '' }}
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>