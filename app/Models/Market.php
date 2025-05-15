<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Market extends Authenticatable implements JWTSubject
{
    use HasFactory,SoftDeletes,ImageTrait;


    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "status"=>"integer",
        "block"=>"integer",
        "city_id"=>"integer",
        'lat' => 'float',
        'lng' => 'float',
        'delivery_price' => 'float',
        'wallet' => 'float',
    ];

    protected $hidden = ['pivot'];

    protected $appends = ['rate','commented','category'];

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"markets");
    }
    public function getlogoAttribute($value){
        return  $this->getImageUrl($value,"markets");
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'markets');
    }
    public function deleteModelLogo(){
        $image = $this->logo;
        $this->deleteImage($image,'markets');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'market_categories','market_id',
            'category_id');
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
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
        $user = Market::find($this->id);
        $user->phone = $user->phone.' '.$user->id;
        $user->email = $user->email.' '.$user->id;
        $user->save();
        ContactUs::where('user_id',$this->id)->where('type','market')->delete();
        Cart::where('market_id',$this->id)->delete();
        parent::delete();
    }
    public function getCommentedAttribute(){
        return Comment::where('market_id',$this->id)->where('user_id',userApi()?->id??0)->exists();
    }
    public function verifies()
    {
        return $this->hasMany(Verify::class);
    }
    public function getRateAttribute(){
        $rates = Comment::where('market_id',$this->id)->pluck('rate')->avg();
        return $rates ?: 0;
    }

    public function getCategoryAttribute(){
        return $this->categories()->first()?->name??__('validation');
    }

}
