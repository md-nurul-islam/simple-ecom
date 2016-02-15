<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\helpers\Custom;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container container-fluid">
    <div class="product-index">

        <h1><?php echo Html::encode($this->title) ?></h1>

        <p>
            <?php echo Html::a(Yii::t('app', 'Profile'), ['profile'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'bill_number',
                'total_amount',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Custom::getOrderStatusArray()[$model->status];
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('app', 'See order details'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            if ($model->status != -1) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' => Yii::t('app', 'Cancel order'),
                                ]);
                            } else {
                                return '';
                            }
                        },],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                            return Url::to(['order', 'id' => $model->id]);
                                }
                                if ($action === 'delete') {
                                    return Url::to(['cancel', 'id' => $model->id]);
                                }
                            }
                    ],
                ],
            ]);
        ?>

    </div>
</div>
