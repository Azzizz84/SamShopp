<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppServiceOrder extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;
    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "user_id"=>"integer",
        'sub_category_id' => 'integer',
        'category_id' => 'integer',
        'deposit_paid' => 'integer',
        'price' => 'float',
        'deposit' => 'float',
    ];



    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function sub_category(){
        return $this->belongsTo(SubCategory::class)->withTrashed();
    }
    public function category(){
        return $this->belongsTo(Category::class)->withTrashed();
    }
    public function address(){
        return $this->belongsTo(Address::class)->withTrashed();
    }
    public function service(){
        return $this->belongsTo(AppService::class,'app_service_id')->withTrashed();
    }
    public function images(){
        return $this->hasMany(AppServiceOrderImages::class);
    }

    public function getvideoAttribute($value){
        if($value){
            return  $this->getImageUrl($value,"app_service_orders");
        }
        return null;

    }

    public function deleteModelVideo(){
        $image = $this->video;
        $this->deleteImage($image,'app_service_orders');
    }
    public function getvideoImageAttribute($value){
        if($value){
            return  $this->getImageUrl($value,"app_service_orders");
        }
        return null;
    }

    public function deleteModelVideoImage(){
        $image = $this->video_image;
        $this->deleteImage($image,'app_service_orders');
    }
}
