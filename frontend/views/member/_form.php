<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helpers\Custom;
use common\models\Member;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container container-fluid">
    <div class="cart-amount-form">

        <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

        <?php echo $form->field($model, 'max_cart_amount')->textInput(['maxlength' => true]); ?>

        <div class="form-group pull-right">
            <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Set'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>