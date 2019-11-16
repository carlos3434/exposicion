<?php

namespace App\Helpers;

class FileUploader
{
    /** @var Storage */
    private $storage;

    public function __construct(\Illuminate\Support\Facades\Storage $storage)
    {
        $this->storage = $storage;
    }

    public function upload($file, $fileFolder)
    {
        //$image_extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$file->getClientOriginalExtension();
        //\Illuminate\Support\Facades\Storage::put('uploads/'.$fileFolder.'/'.$fileName, \File::get($file), 'public');
        $this->storage->put('uploads/'.$fileFolder.'/'.$fileName, $file->getContents(), 'public');

        return $fileName;
    }
}