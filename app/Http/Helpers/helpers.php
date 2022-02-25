<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

if (!function_exists('uploadOne')) {
    function uploadOne($file, $uploadfolder = null, $filename = null, $resize = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);
        $ext = $file->clientExtension();
        // dd($ext);
        $name = $name . '.' . $ext;

        // upload
        $folder = !is_null($uploadfolder) ? 'uploads/' . $uploadfolder : 'uploads/files';
        $path = public_path($folder);

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $imageUrl = $path . '/' . $name;
        $image = Image::make($file);

        // resize image
        if (!is_null($resize)) {
            $size = explode('x', strtolower($resize));
            $image->resize($size[0], $size[1]);
        }
        $image->save($imageUrl);
        $uploadedFile = $folder . '/' . $name;
        return $uploadedFile;
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($path)
    {
        return file_exists($path) && is_file($path) ? @unlink($path) : false;
    }
}

// if (!function_exists('getmenu')) {
//     function getmenu($view)
//     {
//         $view ?? return withError('Please set view to render menu');


//     }
// }
