<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "member_profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $contact_number
 * @property string $avatar
 * @property integer $member_id
 * @property string $created_date
 * @property string $updated_date
 * @property integer $status
 *
 * @property Member $member
 */
class MemberProfile extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'member_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'address', 'contact_number', 'member_id', 'created_date', 'updated_date'], 'required'],
            [['address'], 'string'],
            [['member_id', 'status'], 'integer'],
            [['max_cart_amount'], 'number'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['contact_number'], 'string', 'max' => 30],
            [['avatar'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'contact_number' => Yii::t('app', 'Contact Number'),
            'max_cart_amount' => Yii::t('app', 'Set Cart Amount'),
            'avatar' => Yii::t('app', 'Avatar'),
            'member_id' => Yii::t('app', 'Member ID'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember() {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        $now = date('Y-m-d H:i:s');
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_date = $now;
                $this->status = 1;
            }
            $this->updated_date = $now;
            return true;
        } else {
            return false;
        }
    }

}
