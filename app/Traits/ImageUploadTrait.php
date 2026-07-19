<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

trait ImageUploadTrait {


    public function uploadImage(Request $request, $inputName, $path)
    {
        if($request->hasFile($inputName)){

            $image = $request->{$inputName};
            $this->ensureSafeImage($image);
            File::ensureDirectoryExists(public_path($path));
            $imageName = 'media_'.Str::uuid().'.'.$image->extension();

            $image->move(public_path($path), $imageName);

           return $path.'/'.$imageName;
       }
    }


    public function uploadMultiImage(Request $request, $inputName, $path)
    {
        $imagePaths = [];
        
        if($request->hasFile($inputName)){

            $images = $request->{$inputName};

            foreach($images as $image){

                $this->ensureSafeImage($image);
                File::ensureDirectoryExists(public_path($path));
                $imageName = 'media_'.Str::uuid().'.'.$image->extension();

                $image->move(public_path($path), $imageName);

                $imagePaths[] =  $path.'/'.$imageName;
            }

            return $imagePaths;
       }
    }


    public function updateImage(Request $request, $inputName, $path, $oldPath=null)
    {
        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            $image = $request->{$inputName};
            $this->ensureSafeImage($image);
            File::ensureDirectoryExists(public_path($path));
            $imageName = 'media_'.Str::uuid().'.'.$image->extension();

            $image->move(public_path($path), $imageName);

           return $path.'/'.$imageName;
       }
    }

    /** Handle Delte File */
    public function deleteImage(string $path)
    {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }

    private function ensureSafeImage($image): void
    {
        abort_unless($image->isValid(), 422, 'Invalid image upload.');

        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        abort_unless(in_array($image->getMimeType(), $allowedMimeTypes, true), 422, 'Unsupported image type.');
    }
}
