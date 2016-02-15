<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', $pageTile);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container container-fluid">
    <div class="product-list">

        <h1><?php echo Html::encode($this->title) ?></h1>

        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'options' => [
                'tag' => 'ul',
                'class' => 'list-group list-inline',
                'id' => 'list-wrapper',
            ],
            'itemView' => '/partials/_product_list',
        ]);
        ?>

    </div>
</div>