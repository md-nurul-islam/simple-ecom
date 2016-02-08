<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tmp_cart".
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $product_id
 * @property string $unit_selling_price
 * @property integer $quantity_sold
 * @property string $vat
 * @property string $discount
 * @property string $subtotal_payable
 * @property string $subtotal_paid
 * @property string $created_date
 * @property string $updated_date
 */
class TmpCart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tmp_cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'product_id', 'created_date', 'updated_date'], 'required'],
            [['member_id', 'product_id', 'quantity_sold'], 'integer'],
            [['unit_selling_price', 'vat', 'discount', 'subtotal_payable', 'subtotal_paid'], 'number'],
            [['created_date', 'updated_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'unit_selling_price' => Yii::t('app', 'Unit Selling Price'),
            'quantity_sold' => Yii::t('app', 'Quantity Sold'),
            'vat' => Yii::t('app', 'Vat'),
            'discount' => Yii::t('app', 'Discount'),
            'subtotal_payable' => Yii::t('app', 'Subtotal Payable'),
            'subtotal_paid' => Yii::t('app', 'Subtotal Paid'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }
}
