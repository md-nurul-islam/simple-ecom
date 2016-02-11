<?php
namespace common\helpers;

use yii\helpers\ArrayHelper;

class Custom extends ArrayHelper {
    
    public static function getStatusArray() {
        return [
            0 => 'Inactive',
            1 => 'Active',
        ];
    }
    
    public static function getIsPrivateArray() {
        return [
            0 => 'No',
            1 => 'Yes',
        ];
    }
    
}
