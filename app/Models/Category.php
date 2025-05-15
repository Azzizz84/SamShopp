<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,ImageTrait,SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        'percentage' => 'double',
    ];

    protected $appends = ['name','is_new'];


    protected $hidden = ['name_ar','name_en','pivot'];

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"categories");
    }

    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'categories');
    }
    public function markets(){
        return $this->belongsToMany(Market::class,'market_categories','category_id',
            'market_id');
    }

    public function getNameAttribute(){
        $name = $this->attributes['name_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["name_$lang"])) {
            $name = $this->attributes["name_$lang"];
        }
        return $name;
    }

    public function getisNewAttribute(){
        $currentDate = Carbon::now();
        $oneMonthAgo = $currentDate->subMonth();
        return $this->created_at > $oneMonthAgo;
    }

    function delete()
    {
        MarketCategory::where('category_id',$this->id)->delete();
        parent::delete();
    }
}
