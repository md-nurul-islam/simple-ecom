<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Custom;
?>

<li class="list-group-item">

    <div class="single-product single-shop-product">
        <div class="product-upper">
            <?php
            $img_src = "/uploads/product_image/{$model->resourcesProducts[0]->resources->value}";
            echo Html::img($img_src, ['alt' => $model->display_name]);
            ?>
        </div>
        <h2>
            <?php
            echo Html::a($model->display_name, ['/item', 'id' => $model->id, 'name' => Html::encode($model->name)]);
            ?>
        </h2>
        <div class="product-carousel-price">
            <ins>
                <?php echo Custom::getCurrencySymbol()['bdt'] . ' ' . $model->selling_price; ?>
            </ins>
        </div>  

        <div class="product-option-shop">
            <?php echo Html::a('<i class="fa fa-shopping-cart"></i> Add to cart', Url::to(['/cart', 'id' => $model->id, 'name' => Html::encode($model->name)]), ['class' => 'add-to-cart-link add_to_cart_button_1', 'data-id' => $model->id]); ?>
            <?php // echo Html::a('Add to cart', Url::to(['/cart', 'id' => $model->id, 'name' => Html::encode($model->name)]), ['class' => '', 'data-id' => $model->id]); ?>
        </div>                       
    </div>
</li>