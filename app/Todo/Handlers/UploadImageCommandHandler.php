<?php

namespace App\Todo\Handlers;

use App\Events\ImageUploaded;
use App\Todo\Commands\UploadImageCommand;
use Illuminate\Support\Str;

final class UploadImageCommandHandler
{
    public function handle(UploadImageCommand $command): void
    {
        $imageName = Str::uuid() . '.' . $command->image->extension();
        $command->image->storeAs('images', $imageName);
        $command->item->image = $imageName;
        $command->item->save();
        event(new ImageUploaded(storage_path('app/images') . "/$imageName"));
    }
}
