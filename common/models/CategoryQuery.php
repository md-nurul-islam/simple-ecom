<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class CategoryQuery extends ActiveQuery {

    public function parentCategoryForDropdown() {
        $this->andWhere("parent_catrgory_id IS NULL OR parent_catrgory_id = '' OR parent_catrgory_id = '0' ");
        $this->andWhere('status =:status', [':status' => 1]);
        return $this;
    }

    public function getCategoryForSelect2() {
        
        $data = $this->andWhere('status =:status', [':status' => 1])->all();
        $response = [];
        foreach ($data as $category) {
            $response[$category->id] = $category->display_name;
        }
        
        return $response;
    }

    public function parentCategoryById($id) {
        $this->where(["id" => $id]);
        return $this;
    }
    
    public function getChildCategories($parent_id) {
        $this->where(["parent_catrgory_id" => $parent_id]);
        return $this;
    }

}
