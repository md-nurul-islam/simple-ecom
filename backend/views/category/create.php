<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
