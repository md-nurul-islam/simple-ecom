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
        
        $response = [];
        foreach ($this->all() as $category) {
            $response[$category->id] = $category->display_name;
        }
        
        return $response;
    }

    public function parentCategoryById($id) {
        $this->where(["id" => $id]);
        return $this;
    }

    private function formatForSelect2($categories) {
        
    }

}
