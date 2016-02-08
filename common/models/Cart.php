<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $unit_selling_price
 * @property integer $quantity_sold
 * @property string $vat
 * @property string $discount
 * @property string $subtotal_payable
 * @property string $subtotal_paid
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Order $order
 * @property Product $product
 * @property Order $order0
 * @property Product $product0
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'created_date', 'updated_date'], 'required'],
            [['order_id', 'product_id', 'quantity_sold'], 'integer'],
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
            'order_id' => Yii::t('app', 'Order ID'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder0()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct0()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
