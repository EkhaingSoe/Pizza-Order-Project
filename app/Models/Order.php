<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'customer_id',
        'pizza_id',
        'carrier_id',
        'payment_status',
        'order_time',

    ];
}
