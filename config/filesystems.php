<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    function getImageUrl($value, $folder)
    {
        if ($value) {
            // Check if the image exists in S3
            if (Storage::disk('s3')->exists("$folder/$value")) {
                return Storage::disk('s3')->url("$folder/$value");
            }
            return url('images/place_holder/default.png');
        }
        return url('images/place_holder/default.png');
    }

    function addImage($image, $folder, $oldImage = null): string
    {
        // Delete old image if exists
        if ($oldImage) {
            $this->deleteImage($oldImage, $folder);
        }

        // Generate unique filename
        $extension = $image->extension();
        $fileName = time().'_'.uniqid().'_'.$folder.'.'.$extension;

        // Store in S3
        $path = Storage::disk('s3')->putFileAs(
            $folder,
            $image,
            $fileName,
            'public' // Make the file publicly accessible
        );

        return $fileName;
    }

    function deleteImage($image, $folder)
    {
        // Delete from S3
        if (Storage::disk('s3')->exists("$folder/$image")) {
            Storage::disk('s3')->delete("$folder/$image");
        }
    }
}