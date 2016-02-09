<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'display_name',
            [
                'attribute' => 'parent_catrgory_id',
                'value' => function($model) {
                    if (!empty($model->parent_catrgory_id)) {
                        $parent_category = Category::find()->parentCategoryById($model->parent_catrgory_id)->one();
                        return $parent_category->display_name;
                    } else {
                        return NULL;
                    }
                }
            ],
            'created_date',
            // 'updated_date',
            // 'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
