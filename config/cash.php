<?php

return [
    'default'=> env('CASH_DEFAULT', 'truust'),

    'stripe' => [
        'public_key' => env('STRIPE_PUBLIC_KEY'),
        'secret_key' => env('STRIPE_SECRET_KEY'),
    ],

    'truust' => [
        'public_key' => env('TRUUST_PUBLIC_KEY'),
        'secret_key' => env('TRUUST_SECRET_KEY'),
    ],
];
