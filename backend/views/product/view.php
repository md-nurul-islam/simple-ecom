<?php

use yii\helpers\Html;
use yii\helpers\Url;

//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->display_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo newerton\fancybox\FancyBox::widget([
    'target' => 'a[rel=fancybox]',
    'helpers' => true,
    'mouse' => true,
    'config' => [
        'maxWidth' => '90%',
        'maxHeight' => '90%',
        'playSpeed' => 7000,
        'padding' => 0,
        'fitToView' => false,
        'width' => '70%',
        'height' => '70%',
        'autoSize' => false,
        'closeClick' => false,
        'openEffect' => 'elastic',
        'closeEffect' => 'elastic',
        'prevEffect' => 'elastic',
        'nextEffect' => 'elastic',
        'closeBtn' => false,
        'openOpacity' => true,
        'helpers' => [
            'title' => ['type' => 'float'],
            'buttons' => [],
            'thumbs' => ['width' => 68, 'height' => 50],
            'overlay' => [
                'css' => [
                    'background' => 'rgba(0, 0, 0, 0.8)'
                ]
            ]
        ],
    ]
]);
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
                    <h4><b><?php echo Html::encode($this->title); ?></b></h4>
                </div>

                <div class="panel-body">
                    <ul class="list-group">

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label><?php echo \common\models\Category::attributeLabels()['display_name']; ?></label>
                            </div>
                            <div class="info-wrapper">
                                <?php
                                $productCategories = $model->productCategories;
                                $cat_str = "";
                                foreach ($productCategories as $pc) {
                                    $cat_str .= "{$pc->category->display_name}, ";
                                }
                                echo rtrim($cat_str, ', ');
                                ?>
                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label><?php echo \common\models\Manufacturer::attributeLabels()['name']; ?></label>
                            </div>
                            <div class="info-wrapper">
                                <?php
                                if (!empty($model->productManufacturers)) {
                                    $productManufacturers = $model->productManufacturers;
                                    $man_str = "";
                                    foreach ($productManufacturers as $pm) {
                                        $man_str .= "{$pm->manufacturer->name}, ";
                                    }
                                    echo rtrim($man_str, ', ');
                                } else {
                                    echo '<span class="not-set">(not set)</span>';
                                }
                                ?>
                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label><?php echo $model->attributeLabels()['name']; ?></label>
                            </div>
                            <div class="info-wrapper">
                                <?php echo $model->name; ?>
                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label><?php echo $model->attributeLabels()['display_name']; ?></label>
                            </div>
                            <div class="info-wrapper">
                                <?php echo $model->display_name; ?>
                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right bottom-padding-100">
                                <label><?php echo $model->attributeLabels()['description']; ?></label>
                            </div>
                            <div class="info-wrapper product-description">
                                <?php echo $model->description; ?>
                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label><?php echo $model->attributeLabels()['purchase_price']; ?></label>
                            </div>
                            <div class="info-wrapper">
                                <?php echo number_format($model->purchase_price, 2); ?>
                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label><?php echo $model->attributeLabels()['selling_price']; ?></label>
                            </div>
                            <div class="info-wrapper">
                                <?php echo number_format($model->selling_price, 2); ?>
                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right bottom-padding-100">
                                <label><?php echo 'Images'; ?></label>
                            </div>
                            <div class="info-wrapper">

                                <?php
                                $image_dir = Url::to('/uploads/product_image/');

                                if (!empty($model->resourcesProducts)) {
                                    $resourcesProducts = $model->resourcesProducts;
                                    foreach ($resourcesProducts as $rp) {

                                        if (trim($rp->resources->name) === 'product_image') {
                                            echo Html::a(Html::img("{$image_dir}{$rp->resources->value}", ['height' => 80]), "{$image_dir}{$rp->resources->value}", ['rel' => 'fancybox']);
                                        }
                                    }
                                } else {
                                    echo '<span class="not-set">(not set)</span>';
                                }
                                ?>

                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label for=""><?php echo $model->attributeLabels()['in_home_slider']; ?></label>
                            </div>
                            <div style="padding-bottom: 5px; padding-top: 6px;" class="info-wrapper">
                                <button class="btn btn-<?php echo ($model->in_home_slider) ? 'success' : 'danger'; ?>" type="button">
                                    <?php echo common\helpers\Custom::getYesNoArray()[$model->in_home_slider]; ?>
                                </button>
                            </div>
                        </li>
                        
                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label for=""><?php echo $model->attributeLabels()['top_rated']; ?></label>
                            </div>
                            <div style="padding-bottom: 5px; padding-top: 6px;" class="info-wrapper">
                                <button class="btn btn-<?php echo ($model->top_rated) ? 'success' : 'danger'; ?>" type="button">
                                    <?php echo common\helpers\Custom::getYesNoArray()[$model->top_rated]; ?>
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label for=""><?php echo $model->attributeLabels()['is_private']; ?></label>
                            </div>
                            <div style="padding-bottom: 5px; padding-top: 6px;" class="info-wrapper">
                                <button class="btn btn-<?php echo (!$model->is_private) ? 'success' : 'danger'; ?>" type="button">
                                    <?php echo common\helpers\Custom::getYesNoArray()[$model->is_private]; ?>
                                </button>
                            </div>
                        </li>

                        <li class="list-group-item clearfix">
                            <div class="label-wrapper border-right">
                                <label for=""><?php echo $model->attributeLabels()['status']; ?></label>
                            </div>
                            <div style="padding-bottom: 5px; padding-top: 6px;" class="info-wrapper">
                                <button class="btn btn-<?php echo (!$model->status) ? 'danger' : 'success'; ?>" type="button">
                                    <?php echo common\helpers\Custom::getStatusArray()[$model->status]; ?>
                                </button>
                            </div>
                        </li>

                    </ul>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>
    </div>

</div>