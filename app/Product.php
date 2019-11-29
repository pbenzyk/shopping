<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $fillable = [
        "id_product",
        "name_product",
        "img_product",
        "type_product",
        "price_product",
        "amount_product",
    ];
}
