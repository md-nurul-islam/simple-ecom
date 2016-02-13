<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property string $purchase_price
 * @property string $selling_price
 * @property integer $in_home_slider
 * @property integer $top_rated
 * @property integer $is_private
 * @property string $created_date
 * @property string $updated_date
 * @property integer $status
 *
 * @property Cart[] $carts
 * @property ProductCategory[] $productCategories
 * @property ProductManufacturer[] $productManufacturers
 * @property ResourcesProduct[] $resourcesProducts
 */
class Product extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'created_date', 'updated_date'], 'required'],
            [['description'], 'string'],
            [['purchase_price', 'selling_price'], 'number'],
            [['in_home_slider','top_rated','is_private', 'status'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name', 'display_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Slug'),
            'display_name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'purchase_price' => Yii::t('app', 'Purchased At'),
            'selling_price' => Yii::t('app', 'Sale At'),
            'in_home_slider' => Yii::t('app', 'Show at Home Slider'),
            'top_rated' => Yii::t('app', 'Show at Home Top 10'),
            'is_private' => Yii::t('app', 'Private'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts() {
        return $this->hasMany(Cart::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories() {
        return $this->hasMany(ProductCategory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductManufacturers() {
        return $this->hasMany(ProductManufacturer::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourcesProducts() {
        return $this->hasMany(ResourcesProduct::className(), ['product_id' => 'id']);
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
    
    public static function find() {
        return new ProductQuery(get_called_class());
    }
    
}
