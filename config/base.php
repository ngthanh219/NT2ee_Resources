<?php

return [
    'env' => [
        'multi_store' => env('APP_MULTI_STORE', false),
        'payment_vnpay' => env('APP_PAYMENT_VNPAY', false)
    ],
    'role_id' => [
        'admin' => 0,
        'manage' => 1,
        'staff' => 2,
        'customer' => 3,
        'all' => 4
    ],
    'view' => [
        'show' => 0,
        'hidden' => 1,
        'all' => 3
    ],
    'order_status' => [
        'all' => 0,
        'new' => 1,
        'processing' => 2,
        'shipped' => 3,
        'delivered' => 4,
        'cancelled' => 5
    ],
    'order_status_name' => [
        0 => 'Tất cả',
        1 => 'Mới',
        2 => 'Đang xử lý',
        3 => 'Đang giao hàng',
        4 => 'Đã nhận hàng',
        5 => 'Đã hủy hàng'
    ],
    'restock_on_cancel' => [
        'no' => 0,
        'yes' => 1
    ],
    'is_paid' => [
        'all' => 0,
        'no' => 1,
        'yes' => 2
    ],
    'is_paid_name' => [
        0 => 'Tất cả',
        1 => 'Chưa thanh toán',
        2 => 'Đã thanh toán'
    ],
    'payment_method' => [
        'qr' => 0,
        'ship_cod' => 1,
        'online' => 2
    ],
    'payment_method_name' => [
        0 => 'Chuyển khoản / Quét mã',
        1 => 'Thanh toán khi nhận hàng',
        2 => 'Thanh toán online'
    ],
    'noti' => [
        'success' => 0,
        'error' => 1
    ],
    'pagination' => 15,
    'parent_category_default' => 0,
    'attribute_type' => [
        'all' => 0,
        'color' => 1,
        'size' => 2,
    ],
    'attribute_type_name' => [
        0 => 'Tất cả',
        1 => 'Loại màu',
        2 => 'Loại phiên bản',
    ],
    'supply_type' => [
        'import' => 0,
        'export' => 1
    ],
    'supply_type_name' => [
        0 => 'Nhập',
        1 => 'Xuất'
    ],
];
