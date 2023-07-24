<?php

namespace App\Listeners;

use App\Events\ImageUploaded;
use App\Services\Images\ImageResizer;
use App\Services\Images\Size;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateImageThumbnail implements ShouldQueue
{
    public function __construct(
        private readonly ImageResizer $resizer
    )
    {
    }

    public function handle(ImageUploaded $event): void
    {
        $imageName = basename($event->imagePath);
        $imagePath = pathinfo($event->imagePath, PATHINFO_DIRNAME);
        foreach ($this->getSizes() as $size) {
            $this->resizer->resize(
                $event->imagePath,
                Size::parseByString($size),
                "$imagePath/{$size}_$imageName"
            );
        }
    }

    /**
     * @return string[]
     */
    protected function getSizes(): array
    {
        return config('app.thumbnails.sizes') ?? [];
    }
}
