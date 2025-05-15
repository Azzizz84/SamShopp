<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;


    protected $guarded = [];
    protected $casts = [
        "id"=>"integer",
        "user_id"=>"integer",
        'market_id' => 'integer',
        'address_id' => 'integer',
        'sub_total' => 'float',
        'taxes' => 'float',
        'delivery_price' => 'float',
        'total' => 'float',
    ];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }



    public function market(){
        return $this->belongsTo(Market::class)->withTrashed();
    }

    public function address(){
        return $this->belongsTo(Address::class)->withTrashed();
    }

    public function products(){
        return $this->hasMany(OrderProduct::class)->withTrashed();
    }

}
