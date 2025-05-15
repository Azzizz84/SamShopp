<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;

    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "market_id"=>"integer",
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"sections");
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'sections');
    }

}
