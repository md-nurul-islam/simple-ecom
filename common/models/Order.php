<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $bill_number
 * @property integer $member_id
 * @property string $total_amount
 * @property string $total_payable
 * @property string $total_paid
 * @property string $total_advance
 * @property string $total_due
 * @property string $total_changes
 * @property integer $has_due
 * @property string $created_date
 * @property string $updated_date
 * @property integer $status
 *
 * @property Cart[] $carts
 * @property Cart[] $carts0
 * @property Member $member
 * @property Transaction[] $transactions
 */
class Order extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bill_number', 'member_id', 'created_date', 'updated_date'], 'required'],
            [['bill_number', 'member_id', 'has_due', 'status'], 'integer'],
            [['total_amount', 'total_payable', 'total_paid', 'total_advance', 'total_due', 'total_changes'], 'number'],
            [['created_date', 'updated_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'bill_number' => Yii::t('app', 'Order ID'),
            'member_id' => Yii::t('app', 'Member Name'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'total_payable' => Yii::t('app', 'Total Payable'),
            'total_paid' => Yii::t('app', 'Total Paid'),
            'total_advance' => Yii::t('app', 'Total Advance'),
            'total_due' => Yii::t('app', 'Total Due'),
            'total_changes' => Yii::t('app', 'Total Changes'),
            'has_due' => Yii::t('app', 'Has Due'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts() {
        return $this->hasMany(Cart::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember() {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions() {
        return $this->hasMany(Transaction::className(), ['order_id' => 'id']);
    }

    public function beforeSave($insert) {
        $now = date('Y-m-d H:i:s');
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_date = $now;
                $this->status = 0;
            }
            $this->updated_date = $now;
            return true;
        } else {
            return false;
        }
    }

}
