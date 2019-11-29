<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "ordered";
    protected $fillable = [
        "id_order",
        "id_user",
        "id_product",
        "total_amount",
        "total_price",
    ];
}
