<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'qty',
        'sub_total',
        'order_id',
        'product_id'
    ];


    public function product() {
        return $this->belongsTo(Product::class);
    }
}
