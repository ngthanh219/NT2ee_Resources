<div class="col-sm-2 pl-0">
    <label class="control-label">Danh mục cha</label>
    <select class="form-control" onchange="location = this.value;">
        <option
            value="{{ route('categories.index', ['parent_id' => config('base.parent_category_default')] + $request->all()) }}">
            Tất cả
        </option>

        @foreach ($parentCategories as $parentCategory)
            <option
                value="{{ route('categories.index', ['parent_id' => $parentCategory->id] + $request->all()) }}"
                {{ isset($request->parent_id) && $request->parent_id == $parentCategory->id ? 'selected' : '' }}>
                {{ $parentCategory->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="col-sm-2">
    <label class="control-label">Trạng thái hiển thị</label>
    <select class="form-control" onchange="location = this.value;">
        <option
            value="{{ route('categories.index', ['view' => config('base.view.all')] + $request->all()) }}">
            Tất cả
        </option>
        <option
            value="{{ route('categories.index', ['view' => config('base.view.show')] + $request->all()) }}"
            {{ isset($request->view) && $request->view == config('base.view.show') ? 'selected' : '' }}>
            Đang hiển thị
        </option>
        <option
            value="{{ route('categories.index', ['view' => config('base.view.hidden')] + $request->all()) }}"
            {{ isset($request->view) && $request->view == config('base.view.hidden') ? 'selected' : '' }}>
            Đang ẩn
        </option>
    </select>
</div>