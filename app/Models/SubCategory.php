<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,ImageTrait,SoftDeletes;

    protected $guarded = [];


    protected $casts = [
        "id"=>"integer",
        "category_id"=>"integer",
        'percentage' => 'float',
    ];

    protected $appends = ['name'];


    protected $hidden = ['name_ar','name_en','pivot'];

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"sub_categories");
    }

    public function service_provider(){
        return $this->hasMany(ServiceProvider::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'sub_categories');
    }

    public function getNameAttribute(){
        $name = $this->attributes['name_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["name_$lang"])) {
            $name = $this->attributes["name_$lang"];
        }
        return $name;
    }
}
