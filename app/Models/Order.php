<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total_price',
        'total_payment',
        'total_return',
        'point',
        'used_point',
        'user_id',
        'member_id'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function details() {
        return $this->hasMany(OrderDetail::class);
    }
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
