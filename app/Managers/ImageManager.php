<?php

namespace App\Managers;

use App\Managers\Interfaces\IImageManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class ImageManager implements IImageManager
{
    protected Image $interventionImage;

    public function __construct()
    {
        $this->interventionImage = new Image;
    }

    /**
     * Store an uploaded image file at a specified path.
     *
     * @param UploadedFile $image The image file to be stored.
     * @param string $path The path where the image file should be stored.
     */
    public function storeImage(UploadedFile $image, string $path): void
    {
        $image->storeAs($path);
    }

    /**
     * Create a thumbnail from an uploaded image file and store it at a specified path.
     *
     * @param UploadedFile $image The image file to be used for creating the thumbnail.
     * @param string $thumbnailPath The path where the thumbnail should be stored.
     * @param int $resizeWidth The width to resize the thumbnail.
     * @param int $resizeHeight The height to resize the thumbnail.
     * @param int $quality The quality of the resized thumbnail (default is 90).
     */
    public function createThumbnail(UploadedFile $image, string $thumbnailPath, int $resizeWidth = 300, int $resizeHeight = 200, int $quality = 90, bool $crop = false): void
    {
        if ($crop)
        {
            $thumbnail = Image::make($image->getRealPath())
                ->fit($resizeWidth, $resizeHeight)
                ->encode($image->getClientOriginalExtension(), $quality);
        }
        else
        {
            $thumbnail = Image::make($image->getRealPath())
                ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint)
                {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($image->getClientOriginalExtension(), $quality);
        }

        Storage::put($thumbnailPath, $thumbnail);
    }
}
