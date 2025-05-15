<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory,SoftDeletes,ImageTrait;
    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "block"=>"integer",
        'wallet' => 'float',
    ];

    protected $table = 'users';
    public function getimageAttribute($value){
        return $this->getImageUrl($value,"users");
    }


    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function service_orders(){
        return $this->hasMany(ServiceOrder::class);
    }
    public function app_service_orders(){
        return $this->hasMany(AppServiceOrder::class);
    }
    public function tokens(){
        return $this->hasMany(UserToken::class);
    }
    public function address(){
        return $this->hasMany(Address::class);
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }
    public function chats(){
        return $this->hasMany(Chat::class);
    }



    public function deleteUserImage(){
        $image = $this->image;
        $this->deleteImage($image,'users');
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
        $user = User::find($this->id);
        $user->phone = $user->phone.' '.$user->id;
        $user->email = $user->email.' '.$user->id;
        $user->save();
        ContactUs::where('user_id',$this->id)->where('type','user')->delete();
        parent::delete();

    }


}
