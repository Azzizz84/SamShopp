<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ServiceProvider extends Authenticatable implements JWTSubject
{
    use HasFactory,SoftDeletes,ImageTrait;

    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "block"=>"integer",
        "online"=>"integer",
        "wallet"=>"float",
    ];
    protected $hidden = ['pivot'];

    protected $appends = ['new_order_count','progress_order_count','ended_order_count',];

    public function categories(){
        return $this->belongsToMany(Category::class,'service_provider_categories','service_provider_id',
            'category_id');
    }

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"service_provider");
    }
    public function offers(){
        return $this->hasMany(ServiceOrderOffer::class);
    }
    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'service_provider');
    }
    public function orders(){
        $userId = $this->id;
        $orders = ServiceOrder::whereHas('offers', function($query) use ($userId) {
            $query->where(['service_provider_id'=> $userId,'status'=>'accepted']);
        });
        return $orders;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function delete()
    {
        $user = ServiceProvider::find($this->id);
        $user->phone = $user->phone.' '.$user->id;
        $user->email = $user->email.' '.$user->id;
        $user->save();
        ContactUs::where('user_id',$this->id)->where('type','service_provider')->delete();
        parent::delete();

    }

    public function getnewOrderCountAttribute(){
        $ids = $this->categories->pluck('id')->toArray();
        $orders = ServiceOrder::where('status','new')->whereHas('sub_category', function($query) use ($ids) {
            $query->whereIn('category_id', $ids);
        })->with(['user'=>function($q){
            $q->select('id','name','image','phone');
        },'address']);
        return $orders->count();
    }

    public function getprogressOrderCountAttribute(){
        if(serviceProviderAuth()->check()){
            $to = Carbon::createFromFormat('Y-m-d','3000-1-1')->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d','2000-1-1')->startOfDay();
            return get_service_provider_in_progress_orders($to,$from)->count();
        }
        return  0;
    }
    public function getendedOrderCountAttribute(){
        if(serviceProviderAuth()->check()){
            $to = Carbon::createFromFormat('Y-m-d','3000-1-1')->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d','2000-1-1')->startOfDay();
            return get_service_provider_ended_orders($to,$from)->count();
        }
        return 0;
    }

}
