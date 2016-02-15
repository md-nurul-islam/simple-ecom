<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php // echo Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'bill_number',
            [
                'attribute' => 'member.memberProfiles.name',
                'value' => function ($model) {
                    return $model->member->memberProfiles[0]->name;
                }
            ],
            'total_amount',
            'total_payable',
            // 'total_paid',
            // 'total_advance',
            // 'total_due',
            // 'total_changes',
            // 'has_due',
            // 'created_date',
            // 'updated_date',
            [
                'attribute' => 'order_status',
                'value' => function ($model) {
                    return common\helpers\Custom::getOrderStatusArray()[$model->status];;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
