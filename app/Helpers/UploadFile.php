<?php

namespace App\Helpers;

class FileUploader
{
    /** @var Storage */
    private $storage;

    /** @var File */
    private $fileManager;

    /**
     * @var Storage     $storage
     * @var File        $fileManager
     */
    public function __construct(\Illuminate\Support\Facades\Storage $storage , \File $fileManager)
    {
        $this->storage = $storage;
        $this->fileManager = $fileManager;
    }
    /**
     * @var File        $file
     * @var String      $fileFolder
     * @return String   $fileName
     */
    public function upload($file, $fileFolder)
    {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $this->storage::put('uploads/'.$fileFolder.'/'.$fileName, $this->fileManager::get($file), 'public');
        return $fileName;
    }
}