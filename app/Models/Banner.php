<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory,ImageTrait;

    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
    ];

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"banners");
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'banners');
    }
}
