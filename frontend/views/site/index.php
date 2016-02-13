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
                                                    <?php echo Html::a('Learn more', Url::to(['/item', 'name' => $hsp->name]), ['class' => 'readmore']); ?>
                                                    <!--<a href="" class=""></a>-->
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
                                        <?php echo Html::a('<i class="fa fa-shopping-cart"></i> Add to cart', Url::to(['/cart', 'name' => $tp->name]), ['class' => 'add-to-cart-link']); ?>
                                        <?php echo Html::a('<i class="fa fa-link"></i> See details', Url::to(['/item', 'name' => $tp->name]), ['class' => 'view-details-link']); ?>
                                    </div>
                                </div>

                                <h2><?php echo Html::a($tp->display_name, Url::to(['/item', 'name' => $tp->name])); ?></h2>
                                
                                <div class="product-carousel-price">
                                    <ins><?php echo Custom::getCurrencySymbol()['bdt'] . " {$tp->selling_price}"; ?></ins> <del><?php echo Custom::getCurrencySymbol()['bdt'] . " {$tp->purchase_price}"; ?></del>
                                </div> 
                            </div>
                        
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <h2 class="section-title">Brands</h2>
                    <div class="brand-list">
                        <img src="img/services_logo__1.jpg" alt="">
                        <img src="img/services_logo__2.jpg" alt="">
                        <img src="img/services_logo__3.jpg" alt="">
                        <img src="img/services_logo__4.jpg" alt="">
                        <img src="img/services_logo__1.jpg" alt="">
                        <img src="img/services_logo__2.jpg" alt="">
                        <img src="img/services_logo__3.jpg" alt="">
                        <img src="img/services_logo__4.jpg" alt="">                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top Sellers</h2>
                    <a href="" class="wid-view-more">View All</a>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-2.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Apple new mac book 2015</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-3.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Recently Viewed</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Sony Smart Air Condtion</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-2.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top New</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-3.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End product widget area -->