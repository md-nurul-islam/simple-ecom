<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'model_manufacturer' => $model_manufacturer,
        'model_product_manufacturer' => $model_product_manufacturer,
        'model_category' => $model_category,
        'model_product_category' => $model_product_category,
        'upload_model' => $upload_model,
    ])
    ?>

</div>
