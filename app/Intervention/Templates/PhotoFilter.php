<?php
namespace App\Intervention\Templates\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class PhotoFilter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(120, 90)->greyscale();
    }
}