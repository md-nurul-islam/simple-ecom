<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use common\helpers\Custom;

class ProductQuery extends ActiveQuery {

    public function getHomeSliderProduct() {
        $this->andWhere('in_home_slider =:ihs', [':ihs' => 1]);
        $this->andWhere('status =:status', [':status' => 1]);
        $this->limit(Custom::getCustomConfig()['max_allowed_slider']);
        $this->orderBy('id DESC');
        return $this;
    }
    
    public function getLatestTenProducts() {
        $this->andWhere('top_rated  =:tr', [':tr' => 1]);
        $this->andWhere('status =:status', [':status' => 1]);
        $this->limit(Custom::getCustomConfig()['max_top_rated']);
        $this->orderBy('id DESC');
        return $this;
    }
    
    public function getAllProductsByCategory($category_id) {
        $this->andWhere('status =:status', [':status' => 1]);
        $this->with('productCategories');
        $this->limit(Custom::getCustomConfig()['max_top_rated']);
        $this->orderBy('id DESC');
        return $this;
    }

}
