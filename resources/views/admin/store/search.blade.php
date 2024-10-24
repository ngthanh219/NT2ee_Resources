<form class="input-group" method="GET" action="{{ route('stores.index') }}">
    @foreach ($request->all() as $key => $item)
        @if ($key != 'key')
            <input type="hidden" name="{{ $key }}" value="{{ $item }}">
        @endif
    @endforeach
    <input type="text" name="key" class="form-control" placeholder="Tìm kiếm ..."
        value="{{ isset($request->key) ? $request->key : '' }}">
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Lọc</button>
    </span>
</form>