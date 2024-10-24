<?php

namespace App;

use App\Models\Attribute;
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

    public static function getAttributeTypes()
    {
        $attributeTypes = config('base.attribute_type_name');
        unset($attributeTypes[config('base.attribute_type.all')]);

        return $attributeTypes;
    }

    public static function getAttributes()
    {
        $attributes = [];
        $attributeTypes = self::getAttributeTypes();

        foreach ($attributeTypes as $type => $typeName) {
            $attributes[] = [
                'type' => $type,
                'name' => $typeName,
                'data' => array_merge([
                    [
                        'id' => 0,
                        'name' => '-- Không có --',
                        'description' => 'Không có giá trị'
                    ]
                ], Attribute::where('type', $type)->get(['id', 'name', 'description'])->toArray())
            ];
        }

        return $attributes;
    }

    public static function getOrderStatusName($all = false)
    {
        $orderStatusName = config('base.order_status_name');

        if (!$all) {
            unset($orderStatusName[config('base.order_status.all')]);
        }

        return $orderStatusName;
    }

    public static function getIsPaidName($all = false)
    {
        $isPaidName = config('base.is_paid_name');

        if (!$all) {
            unset($isPaidName[config('base.is_paid.all')]);
        }

        return $isPaidName;
    }
}
