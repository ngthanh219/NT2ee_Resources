<div class="col-sm-2 pl-0">
    <label class="control-label">Trạng thái hiển thị</label>
    <select class="form-control" onchange="location = this.value;">
        <option
            value="{{ route('stores.index', ['view' => config('base.view.all')] + $request->all()) }}">
            Tất cả
        </option>
        <option
            value="{{ route('stores.index', ['view' => config('base.view.show')] + $request->all()) }}"
            {{ isset($request->view) && $request->view == config('base.view.show') ? 'selected' : '' }}>
            Đang hiển thị
        </option>
        <option
            value="{{ route('stores.index', ['view' => config('base.view.hidden')] + $request->all()) }}"
            {{ isset($request->view) && $request->view == config('base.view.hidden') ? 'selected' : '' }}>
            Đang ẩn
        </option>
    </select>
</div>