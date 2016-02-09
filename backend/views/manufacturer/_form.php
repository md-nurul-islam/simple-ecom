<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helpers\Custom;

/* @var $this yii\web\View */
/* @var $model common\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturer-form col-sm-12">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true,]); ?>

    <?php echo $form->field($model, 'address')->textarea(['rows' => 6]); ?>

    <?php echo $form->field($model, 'contact_number')->textInput(['maxlength' => true]); ?>

    <?php if (!empty($model->id)) { ?>
        <?php echo $form->field($model, 'status')->dropDownList(Custom::getStatusArray()); ?>
    <?php } ?>
    
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
