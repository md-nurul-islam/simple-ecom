<?php

use yii\helpers\BaseStringHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Custom;

$num_slider = count($home_slider_product);

if ($num_slider > 0) {
    ?>
    <div class="slider-area">
        <div class="zigzag-bottom"></div>
        <div id="slide-list" class="carousel carousel-fade slide" data-ride="carousel">

            <div class="slide-bulletz">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <ol class="carousel-indicators slide-indicators">
                                <?php
                                foreach (range(0, ($num_slider - 1)) as $num) {
                                    $class = '';
                                    if ($num == 0) {
                                        $class = 'class="active"';
                                    }
                                    ?>
                                    <li data-target="#slide-list" data-slide-to="<?php echo $num; ?>" <?php echo $class; ?>></li>
                                <?php } ?>
                            </ol>

                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-inner" role="listbox">

                <?php
                $num = 0;
                foreach ($home_slider_product as $hsp) {
                    $active = '';
                    if ($num == 0) {
                        $active = ' active';
                    }
                    ?>
                    <div class="item<?php echo $active; ?>">
                        <div class="single-slide">
                            <div class="slide-bg" style="background-image: url(<?php echo "/uploads/product_image/{$hsp->resourcesProducts[0]->resources->value}"; ?>)"></div>
                            <div class="slide-text-wrapper">
                                <div class="slide-text">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-6">
                                                <div class="slide-content">
                                                    <h2><?php echo $hsp->display_name; ?></h2>
                                                    <?php echo Html::a('Learn more', Url::to(['/item', 'id' => $hsp->id, 'name' => Html::encode($hsp->name)]), ['class' => 'readmore']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $num++;
                }
                ?>

            </div>

        </div>        
    </div>
<?php } ?> <!-- End slider area -->


<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-refresh"></i>
                    <p>30 Days return</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-truck"></i>
                    <p>Free shipping</p>
                </div>
            </div>

        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Latest Products</h2>
                    <div class="product-carousel">

                        <?php foreach ($top_ten_products as $tp) { ?>

                            <div class="single-product">
                                <div class="product-f-image">
                                    <?php echo Html::img("/uploads/product_image/{$tp->resourcesProducts[0]->resources->value}", []); ?>
                                    <div class="product-hover">
                                        <?php echo Html::a('<i class="fa fa-shopping-cart"></i> Add to cart', Url::to(['/cart', 'id' => $tp->id, 'name' => Html::encode($tp->name)]), ['class' => 'add-to-cart-link', 'data-id' => $tp->id]); ?>
                                        <?php echo Html::a('<i class="fa fa-link"></i> See details', Url::to(['/item', 'id' => $tp->id, 'name' => Html::encode($tp->name)]), ['class' => 'view-details-link']); ?>
                                    </div>
                                </div>

                                <h2><?php echo Html::a($tp->display_name, Url::to(['/item', 'id' => $tp->id, 'name' => Html::encode($tp->name)])); ?></h2>

                                <div class="product-carousel-price">
                                    <ins><?php echo Custom::getCurrencySymbol()['bdt'] . " {$tp->selling_price}"; ?></ins>
                                </div> 
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

<?php if (!empty($top_ten_manufacturer)) { ?>
    <div class="brands-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <h2 class="section-title">Brands</h2>

                        <div class="brand-list">
                            <?php foreach ($top_ten_manufacturer as $brand) { ?>
                            <div>
                                <?php echo Html::a("<h2>{$brand->name}</h2>", Url::to(['/manufacturer',  'id' => $brand->id, 'name' => Html::encode($brand->name)]), []); ?>
                            </div>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
<?php } ?>