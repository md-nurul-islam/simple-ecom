<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Carts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cart'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'order_id',
            'product_id',
            'unit_selling_price',
            'quantity_sold',
            // 'vat',
            // 'discount',
            // 'subtotal_payable',
            // 'subtotal_paid',
            // 'created_date',
            // 'updated_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>