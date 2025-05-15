<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppService extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;
    protected $guarded = [];

    protected  $appends = ['title','description'];
    protected $hidden = ['title_en','title_ar',
        'description_ar','description_en'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getTitleAttribute(){
        $lang = app()->getLocale();
        return $this->attributes["title_$lang"];
    }

    public function getDescriptionAttribute(){
        $lang = app()->getLocale();
        return $this->attributes["description_$lang"];
    }

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"service");
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'service');
    }
}
