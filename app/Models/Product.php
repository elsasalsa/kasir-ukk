<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_image',
        'product_name',
        'price',
        'stock'
    ];

}
