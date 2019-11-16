<?php
use File;
use Illuminate\Support\Facades\Storage;

if (!function_exists('validateDate')) {
    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}
if (!function_exists('uploadFile')) {
    function uploadFile($file, $fileFolder)
    {
        $image_extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$image_extension;
        Storage::put('uploads/'.$fileFolder.'/'.$fileName, File::get($file), 'public');

        return $fileName;
    }
}