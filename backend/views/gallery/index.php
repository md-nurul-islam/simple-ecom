<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Resources');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resources-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Resources'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'value:ntext',
            'type',
            'created_date',
            // 'updated_date',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
