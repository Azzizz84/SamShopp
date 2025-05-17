<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageTrait
{
    function addImage($image, $folder, $oldImage = null): string {
        if ($oldImage) {
            $this->deleteImage($oldImage);
        }
        
        $path = "/data/uploads/images/{$folder}";
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
        
        $fileName = time().'_'.Str::random(10).'.'.$image->extension();
        $image->move($path, $fileName);
        
        return "images/{$folder}/{$fileName}";
    }

    function getImageUrl($value, $folder) {
        if ($value) {
            // Ensure we're using the full path for URL generation
            return Storage::disk('railway')->url($value);
        }
        return url('images/place_holder/default.png');
    }

    function deleteImage($imagePath) {
        try {
            // Convert stored path to full filesystem path
            $fullPath = '/data/uploads/'.$imagePath;
            
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
            
            // Also try deleting via Storage for consistency
            Storage::disk('railway')->delete($imagePath);
        } catch (\Exception $e) {
            \Log::error("Failed to delete image: {$imagePath} - ".$e->getMessage());
        }
    }
}