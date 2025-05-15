<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory,ImageTrait;
    protected $guarded = [];
    protected $appends =['file_path'];
    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"verifies");
    }
    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'verifies');
    }
    public function getFilePathAttribute()
    {
        return $this->attributes['image'];
    }
}
