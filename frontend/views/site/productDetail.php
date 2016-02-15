<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Custom;
use newerton\fancybox\FancyBox;

echo FancyBox::widget([
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

<div class="container container-fluid">
    <div class="col-sm-12">
        
        <?php echo Html::input('hidden', 'product_id', $data->id, ['id' => 'product_id']); ?>

        <div class="product-content-right">

            <div class="row">
                <div class="col-sm-8">
                    <div class="product-images">
                        <?php if (!empty($data->resourcesProducts)) { ?>
                            <div class="product-main-img">
                                <?php
                                $img_src = "/uploads/product_image/{$data->resourcesProducts[0]->resources->value}";
                                echo Html::a(Html::img("{$img_src}", ['class' => 'product-main-image']), "{$img_src}", ['rel' => 'fancybox']);
                                ?>
                            </div>

                            <div class="product-gallery">
                                <?php foreach ($data->resourcesProducts as $resource) { ?>
                                    <?php
                                    $img_src = "/uploads/product_image/{$resource->resources->value}";
                                    echo Html::a(Html::img("{$img_src}", ['class' => 'product-thumb-image']), "{$img_src}", ['rel' => 'fancybox']);
                                    ?>
                                <?php } ?>
                            </div>

                        <?php } ?>
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="product-inner">
                        <h2 class="product-name">
                            <?php echo $data->display_name; ?>
                        </h2>
                        <div class="product-inner-price">
                            <ins>
                                <?php
                                echo Custom::getCurrencySymbol()['bdt'] . ' ' . $data->selling_price;
                                ?>
                            </ins>
                        </div>

                        <div class="quantity">
                            <?php
                            echo Html::input('number', 'quantity', 1, ['step' => 1, 'min' => 1, 'title' => 'Qty', 'class' => 'input-text qty text', 'size' => 4]);
                            ?>
                        </div>
                        <?php echo Html::a('<i class="fa fa-shopping-cart"></i> Add to cart', Url::to(['/cart', 'id' => $data->id, 'name' => Html::encode($data->name)]), ['class' => 'add_to_cart_button', 'data-id' => $data->id]); ?>

                        <div class="product-inner-category">
                            <p>
                                Category:
                                <?php
                                echo Html::a($data->productCategories[0]->category->display_name, Url::to(['/category', 'id' => $data->productCategories[0]->category->id, 'name' => Html::encode($data->productCategories[0]->category->name)]));
                                ?>
                            </p>
                        </div> 

                        <div role="tabpanel">

                            <ul role="tablist" class="product-tab">
                                <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#home">Description</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active" role="tabpanel">
                                    <h2><?php echo $data->display_name; ?></h2>
                                    <?php echo $data->description; ?>                                    
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>                    
    </div>
</div>