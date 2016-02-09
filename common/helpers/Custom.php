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
    
}
