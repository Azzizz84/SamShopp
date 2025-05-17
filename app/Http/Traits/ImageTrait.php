<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    function getImageUrl($value, $folder)
    {
        if($value) {
            // Check if using temporary storage
            if (Storage::disk('public')->exists('temp_images/'.$value)) {
                return Storage::disk('public')->url('temp_images/'.$value);
            }
            return url('images/'.$folder.'/'.$value);
        } else {
            return url('images/place_holder/default.png');
        }
    }

    function addImage($image, $folder, $oldImage = null): String
    {
        if($oldImage) {
            $this->deleteImage($oldImage, $folder);
        }
        
        // Store in temporary public storage
        $path = $image->store('temp_images', 'public');
        return basename($path); // Return just the filename
    }

    function deleteImage($image, $folder)
    {
        // Try deleting from temporary storage first
        if (Storage::disk('public')->exists('temp_images/'.$image)) {
            Storage::disk('public')->delete('temp_images/'.$image);
        }
        
        // Also try deleting from old path for backward compatibility
        $path = strstr($image, "images/".$folder);
        if(File::exists($path)) {
            File::delete($path);
        }
    }
}