<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Product',
        ]) . ' ' . $model->display_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo
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
