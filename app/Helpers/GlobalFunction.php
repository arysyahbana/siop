<?php

namespace App\Helpers;

class GlobalFunction
{
    public static function formatMoney($money){
        return number_format($money, 0, ',', '.');
    }
    public static function saveImage($image, $name, $path='')
    {
        if ($image == null) {
            return null;
        }
        $extension = $image->getClientOriginalExtension();
        $filename = $name . '.' . $extension;
        $path = public_path('dist/assets/img/' . $path);
        $image->move($path, $filename);
        return $filename;
    }

    public static function deleteImage($filename, $path=''){
        $path = public_path('dist/assets/img/' . $path);
        if (file_exists($path . $filename)) {
            unlink($path . $filename);
        }else{
            // return false;
        }
    }
}
