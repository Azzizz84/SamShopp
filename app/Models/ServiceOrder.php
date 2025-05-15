<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrder extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;

    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "user_id"=>"integer",
        'sub_category_id' => 'integer',
        'deposit_paid' => 'integer',
    ];

    protected $appends = ['offers_count','category',
        'sub_category','accepted_offer','service_provider_offer',];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function offers(){
        return $this->hasMany(ServiceOrderOffer::class);
    }

    public function sub_category(){
        return $this->belongsTo(SubCategory::class)->withTrashed();
    }

    public function address(){
        return $this->belongsTo(Address::class)->withTrashed();
    }
    public function images(){
        return $this->hasMany(ServiceOrderImage::class);
    }
    public function finished_images(){
        return $this->hasMany(ServiceOrderFinishImage::class);
    }

    public function chat(){
        return $this->hasOne(Chat::class);
    }
    public function service_images(){
        return $this->hasMany(ServiceOrderFinishImage::class);
    }

    public function getOffersCountAttribute(){
        return ServiceOrderOffer::where('service_order_id',$this->id)->count();
    }

    public function getcategoryAttribute(){
        return SubCategory::find($this->sub_category_id)->category;
    }

    public function getserviceProviderOfferAttribute(){
        if(serviceProviderAuth()->check()){
            $user = ServiceOrderOffer::where(['service_order_id'=>$this->id,'service_provider_id'=>service_provider_api()->id])->with('service_provider')->first();
            return $user;
        }
        return  null;
    }

    public function getsubCategoryAttribute(){
        return SubCategory::find($this->sub_category_id);
    }

    public function getvideoAttribute($value){
        if($value){
            return  $this->getImageUrl($value,"service_orders");
        }
        return null;

    }

    public function deleteModelVideo(){
        $image = $this->video;
        $this->deleteImage($image,'service_orders');
    }
    public function getvideoImageAttribute($value){
        if($value){
            return  $this->getImageUrl($value,"service_orders");
        }
        return null;
    }

    public function deleteModelVideoImage(){
        $image = $this->video_image;
        $this->deleteImage($image,'service_orders');
    }

    public function getAcceptedOfferAttribute(){
        return ServiceOrderOffer::where(['service_order_id'=>$this->id,'status'=>'accepted'])->with('service_provider')->first();
    }


//    public function getplacedOfferAttribute(){
//        if (serviceProviderAuth()->check()) {
//            $data = ServiceOrderOffer::where(['service_provider_id' => service_provider_api()->id,
//                'service_order_id' => $this->id])->count();
//            if ($data > 0)
//                return true;
//            else
//                return false;
//        } else {
//            return false;
//        }
//    }
}
