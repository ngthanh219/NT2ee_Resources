<div class="row">
    <div class="col-sm-5">
        <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
            Hiển thị {{ $orders->firstItem() }} đến {{ $orders->lastItem() }} trong tổng số
            {{ $orders->total() }} dữ liệu
        </div>
    </div>
    <div class="col-sm-7">
        <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
            <ul class="pagination">
                @foreach ($orders->links()->elements[0] as $key => $item)
                    @if ($orders->links()->paginator->currentPage() == $key)
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