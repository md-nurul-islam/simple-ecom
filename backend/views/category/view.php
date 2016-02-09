<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\Custom;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        echo
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?php
    $parent_category_name = NULL;
    if (!empty($model->parent_catrgory_id)) {
        $parent_category = Category::find()->parentCategoryById($model->parent_catrgory_id)->one();
        $parent_category_name = $parent_category->display_name;
    }
    ?>

    <?php
    echo
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'display_name',
            [
                'attribute' => 'parent_catrgory_id',
                'value' => $parent_category_name
            ],
            'created_date',
            'updated_date',
            [
                'attribute' => 'status',
                'value' => Custom::getStatusArray()[$model->status]
            ],
        ],
    ])
    ?>

</div>
