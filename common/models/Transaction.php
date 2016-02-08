<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $amount
 * @property integer $payment_method
 * @property string $created_date
 * @property string $updated_date
 * @property integer $status
 *
 * @property Order $order
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'amount', 'created_date', 'updated_date'], 'required'],
            [['order_id', 'amount', 'payment_method', 'status'], 'integer'],
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
            'amount' => Yii::t('app', 'Amount'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
