<div class="col-sm-2 pl-0">
    <label class="control-label">Loại</label>
    <select class="form-control" onchange="location = this.value;">
        @foreach (config('base.attribute_type_name') as $key => $item)
            <option
                value="{{ route('attributes.index', ['type' => $key] + $request->all()) }}"
                {{ isset($request->type) && $request->type == $key ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>
</div>