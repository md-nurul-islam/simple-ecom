<?php

use yii\helpers\Html;
use common\helpers\Custom;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manufacturers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <p>
        <?php echo Html::a('Create Manufacturer', ['create'], ['class' => 'btn btn-success']); ?>
    </p>
    
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'name',
            'address:ntext',
            'contact_number',
            'created_date',
            // 'updated_date',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return Custom::getStatusArray()[$model->status];
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'showFooter' => true,
        'layout' => '{summary}{items}{pager}',
        'filterPosition' => 'footer',
    ]);
    ?>

</div>
