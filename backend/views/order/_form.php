<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bill_number')->textInput() ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_payable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_advance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_due')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_changes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'has_due')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
