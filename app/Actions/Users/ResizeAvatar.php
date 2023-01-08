<?php

namespace App\Actions\Users;

use App\Facades\Tinify;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ResizeAvatar
{
    /**
     * @throws FileNotFoundException
     */
    public function resize($path)
    {
        $tinify = Tinify::fromFile(storage_path('app/' . $path));
        $resized = $tinify->resize([
            "method" => "fit",
            "width" => 70,
            "height" => 70
        ]);
        $resized->toFile(storage_path('app/' . $path));
    }
}
