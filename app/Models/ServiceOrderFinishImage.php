<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrderFinishImage extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;
    protected $guarded = [];
    protected $casts = [
        "id"=>"integer",
        "service_order_id"=>"integer",
    ];

    public function getImageAttribute($value){
        return $this->getImageUrl($value,'service_orders');
    }


}
