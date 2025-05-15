<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use HasFactory,SoftDeletes;


    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "order_id"=>"integer",
        'product_id' => 'integer',
        'quantity' => 'integer',
        'price' => 'double',
    ];


    public function order(){
        return $this->belongsTo(Order::class)->withTrashed();
    }


    public function product(){
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
