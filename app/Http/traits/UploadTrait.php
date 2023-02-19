<?php

namespace App\Http\traits;

trait UploadTrait
{
    public function uploadFile($file, $folder = null, $disk = 'public', $filename,$old_file)
    {
        if($old_file){

            // unlink($old_file);
            unlink (public_path($old_file));
        }

        $file->storeAs($folder, $filename, $disk);


    }

public function singleupload(){

    $file = request()->file('file');
    $name = $file->getClientOriginalName();
    $file->move('images',$name);
    return $name;
}

public function multipleupload(){


}


}
