<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "resources".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $type
 * @property string $created_date
 * @property string $updated_date
 * @property integer $status
 *
 * @property ResourcesProduct[] $resourcesProducts
 */
class Resources extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'resources';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'created_date', 'updated_date'], 'required'],
            [['value'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'type' => Yii::t('app', 'Type'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourcesProducts() {
        return $this->hasMany(ResourcesProduct::className(), ['resources_id' => 'id']);
    }

}
