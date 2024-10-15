<?php

namespace App;
use Carbon\Carbon;

class Helper
{
    private static $folder = 'images/';

    public static function uploadFile($oldImg, $image, $basePath)
    {
        $fileName = null;

        if (!is_null($oldImg)) {
            $oldFilePath = public_path(self::$folder . $basePath . '/' . $oldImg);
            $fileName = $oldImg;
        }

        if (!is_null($image)) {
            $time = Carbon::now()->format('Y-m-d-h-i-s');
            $fileName = $time . uniqid() . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $image->move(self::$folder . $basePath, $fileName);

            if (isset($oldFilePath)) {
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        return $basePath . '/' . $fileName;
    }

    public static function removeFile($image)
    {
        $oldFilePath = public_path(self::$folder . $image);

        if (isset($oldFilePath)) {
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    }
}
