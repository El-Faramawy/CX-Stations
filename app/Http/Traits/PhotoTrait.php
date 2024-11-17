<?php

namespace App\Http\Traits;

Trait  PhotoTrait
{
    function saveImage($photo,$folder,$old_image=null){
        $this->deleteImage($old_image);
        return $folder.'/'.$this->storeImage($photo,$folder);
    }

    function storeImage($photo,$folder){
        $file_extension = $photo -> getClientOriginalExtension();
        $file_name = rand('1','9999').time().'.'.$file_extension;
        $path = $folder;
        $photo -> move($path,$file_name);
        return $file_name;
    }

    function deleteImage($image){
        if (file_exists($image))
            unlink($image);
    }

    function deleteImages($images){
        foreach ($images as $image){
            $this->deleteImage($image);
        }
    }
}
