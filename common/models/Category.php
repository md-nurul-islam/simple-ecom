<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property integer $parent_catrgory_id
 * @property string $created_date
 * @property string $updated_date
 * @property integer $status
 *
 * @property ProductCategory[] $productCategories
 */
class Category extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'created_date', 'updated_date'], 'required'],
            [['name'], 'customUnique'],
            [['parent_catrgory_id', 'status'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['display_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Category Slug'),
            'display_name' => Yii::t('app', 'Category Name'),
            'parent_catrgory_id' => Yii::t('app', 'Parent Catrgory'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function customUnique() {

        $data = $this->find()->where('status =:s AND name = :n AND parent_catrgory_id = :p', [
            ':s' => 1,
            ':n' => $this->name,
            ':p' => $this->parent_catrgory_id,
        ])->one();
        
        if(!empty($data)) {
            $this->addError('name', "{$this->name} alreay exists.");
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories() {
        return $this->hasMany(ProductCategory::className(), ['category_id' => 'id']);
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
        return new CategoryQuery(get_called_class());
    }

}
