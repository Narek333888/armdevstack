<?php

namespace App\Managers\Interfaces;

use Illuminate\Http\UploadedFile;

interface IImageManager
{
    public function createThumbnail(UploadedFile $image, string $thumbnailPath, int $resizeWidth, int $resizeHeight, int $quality = 90);
}
