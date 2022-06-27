<?php

namespace Cart\App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{

    protected $table = "web_store_orders";

    protected $fillable = [
        'account',
        'address',
        'order_code',
        'order',
        'status',
    ];
}

