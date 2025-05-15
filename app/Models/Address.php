<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "city_id"=>"integer",
        'user_id' => 'integer',
        'lat' => 'float',
        'lng' => 'float',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function service_orders(){
        return $this->hasMany(ServiceOrder::class);
    }
}
