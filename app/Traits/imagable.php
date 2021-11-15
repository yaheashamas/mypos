<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait imagable {

    public function createImage($pathImage,$path){
        Image::make($pathImage)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/'.$path.$pathImage->hashName()));
        return $pathImage->hashName();
    }

    public function deleteImage($folderName,$imageName){
        Storage::disk('public_upload')->delete('/'.$folderName.$imageName);
    }
}
