<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait imagable {

    public function createImage($Image,$path){
        Image::make($Image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/'.$path.$Image->hashName()));
        return $Image->hashName();
    }

    public function deleteImage($folderName,$imageName){
        Storage::disk('public_upload')->delete('/'.$folderName.$imageName);
    }
}
