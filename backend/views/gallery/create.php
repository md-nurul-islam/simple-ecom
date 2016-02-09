<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Resources */

$this->title = Yii::t('app', 'Create Resources');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resources'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resources-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
