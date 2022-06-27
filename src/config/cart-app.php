<?php

return [
    "cart_key" => env("FERAMY_CART_KEY"),
    "payment_methods"   => [
        "paypal"        => env("CHECKOUT_WITH_PAYPAL") ?? false,
        "stripe"        => env("CHECKOUT_WITH_STRIPE") ?? false,
        "shoppingos"    => env("CHECKOUT_WITH_SHOPPINGOS") ?? false,
        "bank_transfer" => env("CHECKOUT_WITH_BANK_TRANSFER") ?? false,
    ]
];