<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->display_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view view">

    <p>
        <?php echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <div class="box box-info">
        <div class="box-body">

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h4><b><?php echo Html::encode($this->title) ?></b></h4>
                </div>

                <div class="panel-body">

                    <ul class="list-group">
                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label for="">Category Name</label>
                            </div>
                            <div class="info-wrapper">
                                Casual Shirts
                            </div>
                        </li>
                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label for="">Supplier Name</label>
                            </div>
                            <div class="info-wrapper">
                                Default
                            </div>
                        </li>
                        
                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label for="">Status</label>
                            </div>
                            <div style="padding-bottom: 5px; padding-top: 6px;" class="info-wrapper">
                                <button class="btn btn-success" type="button">
                                    Active
                                </button>
                            </div>
                        </li>
                    </ul>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>
    </div>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'display_name',
            'description:ntext',
            'purchase_price',
            'selling_price',
            'is_private',
            'created_date',
            'updated_date',
            'status',
        ],
    ])
    ?>

</div>

<style type="text/css">
    .view .border-right {
        border-right: 1px solid #dddddd;
    }
    .view .label-wrapper, .view .info-wrapper {
        padding-bottom: 10px;
        padding-top: 10px;
        float: left;
    }
    .view .label-wrapper {
        width: 25%;
    }
    .view .info-wrapper {
        padding-left: 15px;
        width: 75%;
    }
    .view .list-group-item {
        padding-bottom: 0;
        padding-top: 0;
    }
    .view .barcode-wrapper, .barcode-content-for-modal {
        display: none;
    }
    .view .barcode-container {
        padding: 15px 0;
    }
    .abs-middle {
        text-align: center;
        vertical-align: middle !important;
    }
</style>