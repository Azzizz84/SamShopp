<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppServiceOrderImages extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;
    protected $guarded = [];
    protected $casts = [
        "id"=>"integer",
        "app_service_order_id"=>"integer",
    ];

    public function service_order(){
        return $this->belongsTo(AppServiceOrder::class);
    }

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"app_service_orders");
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'app_service_orders');
    }
}
