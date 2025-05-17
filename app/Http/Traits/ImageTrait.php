<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

Trait  ImageTrait
{
    function addImage($image, $folder, $oldImage = null): String {
    if ($oldImage) {
        $this->deleteImage($oldImage, $folder);
    }
    
    // Ensure directory exists
    $path = "/data/uploads/images/{$folder}";
    if (!File::exists($path)) {
        File::makeDirectory($path, 0755, true);
    }
    
    $extension = $image->extension();
    $fileName = time().'_'.Str::random(10).'.'.$extension;
    
    // Store in Railway volume
    $image->move("{$path}", $fileName);
    
    return "images/{$folder}/{$fileName}";
}

function getImageUrl($value, $folder) {
    if ($value) {
        return url("storage/{$value}");
    }
    return url('images/place_holder/default.png');
}

    function deleteImage($image,$folder){

        $path =strstr($image,"images/".$folder);
        if(File::exists($path)) {
            File::delete($path);
        }
    }
}
