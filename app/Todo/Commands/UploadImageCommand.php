<?php

namespace App\Todo\Commands;

use App\Todo\Models\TodoItem;
use Illuminate\Http\UploadedFile;

final class UploadImageCommand
{
    public function __construct(
        readonly TodoItem $item,
        readonly UploadedFile $image
    )
    {
    }
}
