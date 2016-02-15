<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helpers\Custom;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?php echo $form->field($model, 'bill_number')->textInput(['disabled' => true]); ?>

    <?php echo $form->field($model, 'total_amount')->textInput(['maxlength' => true, 'disabled' => true]); ?>

    <?php echo $form->field($model, 'total_payable')->textInput(['maxlength' => true, 'disabled' => true]); ?>

    <?php
    echo $form->field($model, 'status')->dropDownList(Custom::getOrderStatusArray());
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
