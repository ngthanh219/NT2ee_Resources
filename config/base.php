<?php

return [
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
        'pending' => 0,
        'comfirm' => 1,
        'shipping' => 2,
        'cancel' => 3
    ],
    'is_paid' => [
        'no' => 0,
        'yes' => 1
    ],
    'payment_method' => [
        'qr' => 0,
        'ship_cod' => 1,
        'online' => 2
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
        'size' => 2
    ],
    'attribute_type_name' => [
        0 => 'Tất cả',
        1 => 'Loại màu',
        2 => 'Loại phiên bản'
    ]
];
