<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class CategoryQuery extends ActiveQuery {

    public function parentCategoryForDropdown() {
        $this->andWhere("parent_catrgory_id IS NULL OR parent_catrgory_id = '' OR parent_catrgory_id = '0' ");
        return $this;
    }

    public function getCategoryForSelect2() {

        $categories = $this->all();

        $ar_parent_cat_ids = array_map(function($category) {
            if (empty($category->parent_catrgory_id)) {
                return $category->id;
            }
        }, $categories);

        $ar_child_cat_ids = array_map(function($category) {
            if (!empty($category->parent_catrgory_id)) {
                return $category->id;
            }
        }, $categories);

        $ar_parent_cat_ids = array_unique(array_filter($ar_parent_cat_ids));
        $ar_child_cat_ids = array_unique(array_filter($ar_child_cat_ids));

        var_dump($ar_child_cat_ids);
        exit;

        foreach ($categories as $category) {
            
        }

        exit;

        return $this;
    }

    public function parentCategoryById($id) {
        $this->where(["id" => $id]);
        return $this;
    }

    private function formatForSelect2($categories) {
        
    }

}
