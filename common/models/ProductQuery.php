<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class ProductQuery extends ActiveQuery {

    public function getHomeSliderProduct() {
        $this->andWhere('in_home_slider =:ihs', [':ihs' => 1]);
        $this->andWhere('status =:status', [':status' => 1]);
        $this->limit(3);
        $this->orderBy('id DESC');
        return $this;
    }
    
    public function getLatestTenProducts() {
        $this->andWhere('top_rated  =:tr', [':tr' => 1]);
        $this->andWhere('status =:status', [':status' => 1]);
        $this->limit(10);
        $this->orderBy('id DESC');
        return $this;
    }

}
