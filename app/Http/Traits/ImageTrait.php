<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

Trait  ImageTrait
{
    function getImageUrl($value,$folder)
    {
        if($value){
            return url('images/'.$folder.'/'.$value);
        }else{
            return url('images/place_holder/default.png');
        }
    }

    function addImage($image,$folder,$oldImage = null) :String{
        if($oldImage){
            $this->deleteImage($oldImage,$folder);
        }
        $extension = $image->extension();
        $time = intval(microtime(true) * 1000000);
        $fileName = $time.'_'.$folder.'.'.$extension;
        $image->move(public_path('images/'.$folder),$fileName);
        return $fileName;
    }
    function deleteImage($image,$folder){

        $path =strstr($image,"images/".$folder);
        if(File::exists($path)) {
            File::delete($path);
        }
    }
}
