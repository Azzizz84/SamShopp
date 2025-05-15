<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrderImage extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;
    protected $guarded = [];
    protected $casts = [
        "id"=>"integer",
        "service_order_id"=>"integer",
    ];

    public function service_order(){
        return $this->belongsTo(ServiceOrder::class);
    }

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"service_orders");
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'service_orders');
    }
}
