<div class="col-sm-2 pl-0">
    <label class="control-label">Loại tài khoản</label>
    <select class="form-control" onchange="location = this.value;">
        <option value="{{ route('users.index', ['role_id' => config('base.role_id.all')] + $request->all()) }}">
            Tất cả
        </option>
        <option value="{{ route('users.index', ['role_id' => config('base.role_id.admin')] + $request->all()) }}"
            {{ isset($request->role_id) && $request->role_id == config('base.role_id.admin') ? 'selected' : '' }}>
            Admin
        </option>
        {{-- <option value="{{ route('users.index', ['role_id' => config('base.role_id.manage')] + $request->all()) }}"
            {{ isset($request->role_id) && $request->role_id == config('base.role_id.manage') ? 'selected' : '' }}>
            Quản lý
        </option>
        <option value="{{ route('users.index', ['role_id' => config('base.role_id.staff')] + $request->all()) }}"
            {{ isset($request->role_id) && $request->role_id == config('base.role_id.staff') ? 'selected' : '' }}>
            Nhân viên
        </option> --}}
        <option value="{{ route('users.index', ['role_id' => config('base.role_id.customer')] + $request->all()) }}"
            {{ isset($request->role_id) && $request->role_id == config('base.role_id.customer') ? 'selected' : '' }}>
            Khách hàng
        </option>
    </select>
</div>