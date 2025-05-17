<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Trait  ImageTrait
{
    function addImage($image, $folder, $oldImage = null): String {
    if ($oldImage) {
        $this->deleteImage($oldImage, $folder);
    }
    
    $path = "/data/uploads/images/{$folder}";
    if (!File::exists($path)) {
        File::makeDirectory($path, 0755, true);
    }
    
    $fileName = time().'_'.Str::random(10).'.'.$image->extension();
    $image->move($path, $fileName);
    
    return "images/{$folder}/{$fileName}"; // This is the path to store in DB
}

function getImageUrl($value, $folder) {
    if ($value) {
        return Storage::disk('railway')->url($value);
    }
    return url('images/place_holder/default.png');
}

function deleteImage($image, $folder) {
    Storage::disk('railway')->delete($image);
}
}
