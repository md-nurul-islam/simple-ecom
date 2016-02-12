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
class GoogleFontsAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600',
        '//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300',
        '//fonts.googleapis.com/css?family=Raleway:400,100'
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}
