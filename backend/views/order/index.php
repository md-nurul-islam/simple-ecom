<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bill_number',
            'member_id',
            'total_amount',
            'total_payable',
            // 'total_paid',
            // 'total_advance',
            // 'total_due',
            // 'total_changes',
            // 'has_due',
            // 'created_date',
            // 'updated_date',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
