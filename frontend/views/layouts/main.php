<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\GoogleFontsAsset;
use common\widgets\Alert;
use common\models\Category;
use common\models\Manufacturer;

AppAsset::register($this);
GoogleFontsAsset::register($this);
$this->title = 'yiiCommerce';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo Html::csrfMetaTags() ?>
        <title><?php echo Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody(); ?>
        <?php if (!Yii::$app->user->isGuest) { ?>
            <?php echo Html::input('hidden', 'user_id', Yii::$app->user->identity->id, ['id' => 'user_id']); ?>
        <?php } ?>

        <div class="header-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="user-menu">
                            <ul>
                                <li><?php echo Html::a('<i class="fa fa-user"></i>My Account', Url::to(['/member/profile'])); ?>
                                <li><a href="/cart"><i class="fa fa-cart-plus"></i> My Cart</a></li>
                                <?php
                                $login_out_text = 'Login';
                                $login_out_url = ['/site/login'];
                                if (!Yii::$app->user->isGuest) {
                                    $login_out_text = 'Logout';
                                    $login_out_url = ['/site/logout'];
                                }
                                ?>
                                <li><?php echo Html::a("<i class=\"fa fa-user\"></i>{$login_out_text}", Url::to($login_out_url), ['data-method' => 'post']); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End header area -->

        <div class="site-branding-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo">
                            <h1><?php echo Html::a('yii<span>Commerce</span>', Url::to([''])); ?></h1>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="shopping-item">

                            <?php echo Html::a('Cart - <span class="cart-amunt">BDT 0.00</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">0</span>', Url::to(['/cart'])); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End site branding area -->

        <div class="mainmenu-area">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div> 
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="parent-menu"><?php echo Html::a('Home', Url::to(['/'])); ?></li>
                            <li class="dropdown parent-menu">
                                <?php
                                echo Html::a('Category', Url::to(['/category']), [
                                    'data-toggle' => 'dropdown',
                                    'data-hover' => 'dropdown',
                                    'class' => 'dropdown-toggle'
                                ]);
                                ?>
                                <ul class="dropdown-menu list-group">
                                    <?php
                                    $categories = Category::find()->where('status = :s', [':s' => 1])->all();
                                    foreach ($categories as $category) {
                                        ?>
                                        <li class="list-group-item">
                                            <?php echo Html::a($category->display_name, Url::to(['/category', 'id' => $category->id, 'name' => Html::encode($category->name)])); ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="dropdown parent-menu">
                                <?php
                                echo Html::a('Manufacturer', Url::to(['/manufacturer']), [
                                    'data-toggle' => 'dropdown',
                                    'data-hover' => 'dropdown',
                                    'class' => 'dropdown-toggle'
                                ]);
                                ?>
                                <ul class="dropdown-menu list-group">
                                    <?php
                                    $manufacturers = Manufacturer::find()->where('status = :s', [':s' => 1])->all();
                                    foreach ($manufacturers as $manufacturer) {
                                        ?>
                                        <li class="list-group-item">
                                            <?php echo Html::a($manufacturer->name, Url::to(['/manufacturer', 'id' => $manufacturer->id, 'name' => Html::encode($manufacturer->name)])); ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="parent-menu"><?php echo Html::a('Shop', Url::to(['/shop'])); ?></li>
                            <li class="parent-menu"><?php echo Html::a('Cart', Url::to(['/cart'])); ?></li>
                            <li class="parent-menu"><?php echo Html::a('Contact', Url::to(['/contact'])); ?></li>
                        </ul>
                    </div>  
                </div>
            </div>
        </div> <!-- End mainmenu area -->

        <?php echo $content; ?>

        <div class="footer-top-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-about-us">
                            <h2>yii<span>Commerce</span></h2>
                            <div class="footer-social">
                                <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-menu">
                            <h2 class="footer-wid-title">User Navigation </h2>
                            <ul>
                                <li><?php echo Html::a('<i class="fa fa-user"></i>My Account', Url::to(['/member/profile'])); ?>
                                <li><a href="/cart"><i class="fa fa-cart-plus"></i> My Cart</a></li>
                                <?php
                                $login_out_text = 'Login';
                                $login_out_url = ['/site/login'];
                                if (!Yii::$app->user->isGuest) {
                                    $login_out_text = 'Logout';
                                    $login_out_url = ['/site/logout'];
                                }
                                ?>
                                <li><?php echo Html::a("<i class=\"fa fa-user\"></i>{$login_out_text}", Url::to($login_out_url), ['data-method' => 'post']); ?></li>
                            </ul>                       
                        </div>
                    </div>


                </div>
            </div>
        </div> <!-- End footer top area -->

        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright">
                            <p>&copy; 2016 yiiCommerce. All Rights Reserved. Coded with <i class="fa fa-heart"></i> by <a href="mailto:webdev.nislam@gmail.com" target="_blank">Yii2</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- End footer bottom area -->

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
