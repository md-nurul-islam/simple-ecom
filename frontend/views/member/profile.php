<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\Custom;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Profile'), 'url' => ['account']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="profile-view">

        <h1><?php echo Html::encode($this->title) ?></h1>

        <p>
            <?php
            echo Html::a(Yii::t('app', 'Orders'), ['orders'], [
                'class' => 'btn btn-info',
                'data' => [
                    'method' => 'post',
                ],
            ]);
            echo Html::a(Yii::t('app', 'Set Cart Amount'), ['cart_amount'], [
                'class' => 'btn btn-warning',
                'data' => [
                    'method' => 'post',
                ],
            ]);
            ?>
        </p>

        <?php
//    $parent_category_name = NULL;
//    if (!empty($model->parent_catrgory_id)) {
//        $parent_category = Category::find()->parentCategoryById($model->parent_catrgory_id)->one();
//        $parent_category_name = $parent_category->display_name;
//    }
        ?>

        <?php
        echo
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'email',
                [
                    'attribute' => 'name',
                    'value' => $model->memberProfiles[0]->name
                ],
                [
                    'attribute' => 'address',
                    'value' => $model->memberProfiles[0]->address
                ],
                [
                    'attribute' => 'contact_number',
                    'value' => $model->memberProfiles[0]->contact_number
                ],
                [
                    'attribute' => 'max_cart_amount',
                    'value' => Custom::getCurrencySymbol()['bdt'] . ' ' . number_format($model->memberProfiles[0]->max_cart_amount, 2)
                ],
            ],
        ])
        ?>
    </div>
</div>
