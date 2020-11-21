<?php

namespace App\Traits;


trait PostTraits
{

    function saveImages($image, $folder)
    {

        $fileExtension = $image->getClientOriginalExtension();
        $fileName = time() . '.' . $fileExtension;
        $path = $folder;
        $image->move($path, $fileName);
        return $fileName;
    }
}
