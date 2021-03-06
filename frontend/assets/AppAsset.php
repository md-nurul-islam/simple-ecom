<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/font-awesome.min.css',
        'css/owl.carousel.css',
        'css/owl.carousel.css',
        'css/style.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/cookie.js',
        'js/owl.carousel.min.js',
        'js/jquery.easing.1.3.min.js',
        'js/jquery.sticky.js',
        'js/main.js',
        'js/bootstrap.min.js',
        'js/cart.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
