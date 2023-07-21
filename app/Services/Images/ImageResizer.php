<?php

namespace App\Services\Images;

interface ImageResizer
{
    public function resize(string $path, Size $toSize, string $saveToPath);
}
