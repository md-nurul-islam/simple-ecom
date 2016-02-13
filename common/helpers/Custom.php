<?php
namespace common\helpers;

use yii\helpers\ArrayHelper;

class Custom extends ArrayHelper {
    
    public static function getCustomConfig() {
        return [
            'max_allowed_slider' => 3,
            'max_top_rated' => 10,
        ];
    }
    
    public static function getCurrencySymbol() {
        return [
            'bdt' => 'BDT',
            'usd' => '$',
        ];
    }
    
    public static function getStatusArray() {
        return [
            0 => 'Inactive',
            1 => 'Active',
        ];
    }
    
    public static function getYesNoArray() {
        return [
            0 => 'No',
            1 => 'Yes',
        ];
    }
    
}
