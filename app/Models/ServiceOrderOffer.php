<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrderOffer extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "service_order_id"=>"integer",
        'service_provider_id' => 'integer',
        'deposit' => 'float',
        'price' => 'float',
    ];

    public function service_order(){
        return $this->belongsTo(ServiceOrder::class);
    }

    public function service_provider(){
        return $this->belongsTo(ServiceProvider::class);
    }
}
