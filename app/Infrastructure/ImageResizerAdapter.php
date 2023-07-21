<?php

namespace App\Infrastructure;

use App\Services\Images\ImageResizer;
use App\Services\Images\Size;
use Intervention\Image\Facades\Image;

final class ImageResizerAdapter implements ImageResizer
{
    public function resize(string $path, Size $toSize, string $saveToPath)
    {
        Image::make($path)
            ->resize($toSize->width, $toSize->height)
            ->save($saveToPath);
    }
}
