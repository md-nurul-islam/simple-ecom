<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'display_name',
            'name',
            'purchase_price',
            'selling_price',
            [
                'attribute' => 'in_home_slider',
                'format' => 'raw',
                'value' => function ($model) {
                    $btn_class = ($model->in_home_slider) ? 'success' : 'danger';
                    $yes_no = common\helpers\Custom::getYesNoArray()[$model->in_home_slider];
                    return "<button class=\"btn btn-{$btn_class}\" type=\"button\">{$yes_no}</button>";
                }
            ],
            [
                'attribute' => 'top_rated',
                'format' => 'raw',
                'value' => function ($model) {
                    $btn_class = ($model->top_rated) ? 'success' : 'danger';
                    $yes_no = common\helpers\Custom::getYesNoArray()[$model->top_rated];
                    return "<button class=\"btn btn-{$btn_class}\" type=\"button\">{$yes_no}</button>";
                }
            ],
            [
                'attribute' => 'is_private',
                'format' => 'raw',
                'value' => function ($model) {
                    $btn_class = (!$model->is_private) ? 'success' : 'danger';
                    $yes_no = common\helpers\Custom::getYesNoArray()[$model->is_private];
                    return "<button class=\"btn btn-{$btn_class}\" type=\"button\">{$yes_no}</button>";
                }
            ],
            // 'created_date',
            // 'updated_date',
            // 'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
