<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "resources_product".
 *
 * @property integer $id
 * @property integer $resources_id
 * @property integer $product_id
 *
 * @property Product $product
 * @property Resources $resources
 */
class ResourcesProduct extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'resources_product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['resources_id', 'product_id'], 'required'],
            [['resources_id', 'product_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'resources_id' => Yii::t('app', 'Resources ID'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources() {
        return $this->hasOne(Resources::className(), ['id' => 'resources_id']);
    }

}
