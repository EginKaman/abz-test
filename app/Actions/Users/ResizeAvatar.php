<?php

namespace App\Actions\Users;

use App\Facades\Tinify;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\UploadedFile;

class ResizeAvatar
{
    /**
     * @throws FileNotFoundException
     */
    public function resize($path)
    {
       $tinify = Tinify::fromFile($path);
       $tinify->resize([
           "method" => "fit",
           "width" => 70,
           "height" => 70
       ]);
       $tinify->toFile($path);
        // TODO: Implement __invoke() method.
    }
}
