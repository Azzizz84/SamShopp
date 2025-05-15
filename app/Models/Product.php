<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;

    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "section_id"=>"integer",
        'price' => 'float',
        'offer_price' => 'float',
    ];

    public function getimageAttribute($value){
        return  $this->getImageUrl($value,"products");
    }

    public function deleteModelImage(){
        $image = $this->image;
        $this->deleteImage($image,'products');
    }

    public function delete(){
        Cart::where('product_id',$this->id)->delete();
        parent::delete();
    }
}
