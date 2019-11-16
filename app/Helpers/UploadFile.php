<?php
use File;
use Illuminate\Support\Facades\Storage;
namespace App\Helpers;

class UploadFile
{
    public function uploadFile($file, $fileFolder)
    {
        $image_extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$image_extension;
        Storage::put('uploads/'.$fileFolder.'/'.$fileName, File::get($file), 'public');

        return $fileName;
    }
}