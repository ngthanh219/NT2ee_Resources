<?php

return [
    'role_id' => [
        'admin' => 0,
        'manage' => 1,
        'staff' => 2,
        'customer' => 3
    ],
    'view' => [
        'show' => 0,
        'hidden' => 1
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
    ]
];
