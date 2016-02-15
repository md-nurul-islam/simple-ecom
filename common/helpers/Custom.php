<?php
namespace common\helpers;

use yii\helpers\ArrayHelper;

class Custom extends ArrayHelper {
    
    public static function getCustomConfig() {
        return [
            'max_allowed_slider' => 3,
            'max_top_rated' => 10,
            'max_allowed_manufacturer' => 10,
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
    
    public static function getOrderStatusArray() {
        return [
            -1 => 'Cancelled',
            0 => 'New',
            1 => 'Ready to deliver',
            2 => 'Delivered',
        ];
    }
    
    public static function getYesNoArray() {
        return [
            0 => 'No',
            1 => 'Yes',
        ];
    }
    
    public static function getPaymentMethods() {
        return [
            0 => 'Cash on Delivery',
            1 => 'Direct Bank Transfer',
        ];
    }
    
    public static function getUniqueId($id = 0, $max_length = 12) {

        $id_len = strlen($id);
        $max_len = $max_length - $id_len;

        $unique_id = (string) microtime(true);
        $unique_id = str_replace('.', '', $unique_id);

        $n_unique_id = substr($unique_id, $id_len);
        $n_unique_id_len = strlen($n_unique_id);

        $nn_unique_id = '';
        $nn_unique_id = substr($n_unique_id, -$max_len);

        $ref_num = ($id > 0) ? $id . $nn_unique_id : $nn_unique_id;
        if (strlen($ref_num) < $max_length) {
            for ($i = strlen($ref_num); $i < $max_length; $i++) {
                $ref_num .= mt_rand(0, 9);
            }
        }

        return $ref_num;
    }
    
}
