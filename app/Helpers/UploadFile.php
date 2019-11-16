<?php

namespace App\Helpers;

class FileUploader
{
    /** @var Storage */
    private $storage;

    /** @var File */
    private $fileManager;

    public function __construct(\Illuminate\Support\Facades\Storage $storage , \File $fileManager)
    {
        $this->storage = $storage;
        $this->fileManager = $fileManager;
    }

    public function upload($file, $fileFolder)
    {
        //$image_extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$file->getClientOriginalExtension();
        //\Illuminate\Support\Facades\Storage::put('uploads/'.$fileFolder.'/'.$fileName, \File::get($file), 'public');
        $this->storage::put('uploads/'.$fileFolder.'/'.$fileName, $this->fileManager::get($file), 'public');

        return $fileName;
    }
}