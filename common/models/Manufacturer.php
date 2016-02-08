<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "manufacturer".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $contact_number
 * @property string $created_date
 * @property string $updated_date
 * @property integer $status
 *
 * @property ProductManufacturer[] $productManufacturers
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_date', 'updated_date'], 'required'],
            [['address'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['contact_number'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'contact_number' => Yii::t('app', 'Contact Number'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductManufacturers()
    {
        return $this->hasMany(ProductManufacturer::className(), ['manufacturer_id' => 'id']);
    }
}
