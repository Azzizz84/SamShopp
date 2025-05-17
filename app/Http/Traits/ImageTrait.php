<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    function getImageUrl($value, $folder)
    {
        if($value) {
            return Storage::disk('public')->url("images/{$folder}/{$value}");
        } else {
            return asset('images/place_holder/default.png');
        }
    }

    function addImage($image, $folder, $oldImage = null): string
    {
        if($oldImage) {
            $this->deleteImage($oldImage, $folder);
        }
        
        $extension = $image->extension();
        $time = intval(microtime(true) * 1000000);
        $fileName = $time.'_'.$folder.'.'.$extension;
        
        // Store the image in the public disk
        $path = $image->storeAs("public/images/{$folder}", $fileName);
        
        return $fileName;
    }

    function deleteImage($image, $folder)
    {
        $imagePath = "public/images/{$folder}/{$image}";
        if(Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    }
}