<?php

namespace frontend\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class ApMembersQuery extends ActiveQuery {
    
    public function getAffiliateByEmail($email) {
        $this->where(["email" => $email]);
        return $this;
    }
    
}