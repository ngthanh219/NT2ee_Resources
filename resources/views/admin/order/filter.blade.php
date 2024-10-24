<div class="col-sm-2 pl-0">
    <label class="control-label">Trạng thái đơn hàng</label>
    <select class="form-control" name="status" onchange="location = this.value;">
        @foreach ($orderStatusName as $index => $name)
            <option
                value="{{ route('orders.index', ['status' => $index] + $request->all()) }}"
                {{ isset($request->status) && $request->status == $index ? 'selected' : '' }}
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
<div class="col-sm-2 pl-0">
    <label class="control-label">Trạng thái thanh toán</label>
    <select class="form-control" name="is_paid" onchange="location = this.value;">
        @foreach ($isPaidName as $index => $name)
            <option
                value="{{ route('orders.index', ['is_paid' => $index] + $request->all()) }}"
                {{ isset($request->is_paid) && $request->is_paid == $index ? 'selected' : '' }}
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>