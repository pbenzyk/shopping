<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $table = "type_product";
    protected $fillable = [
        "id_type",
        "name_type",
        "img_type",
    ];
}
