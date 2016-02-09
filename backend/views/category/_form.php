<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helpers\Custom;
use common\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?php echo $form->field($model, 'display_name')->textInput(['maxlength' => true]); ?>

    <?php
    $data_parent_categories = ArrayHelper::map(Category::find()->parentCategoryForDropdown()->asArray()->all(), 'id', 'display_name');
    echo $form->field($model, 'parent_catrgory_id')->dropDownList($data_parent_categories, [
        'prompt' => 'Select'
    ]);
    ?>

    <?php if (!empty($model->id)) { ?>
        <?php echo $form->field($model, 'status')->dropDownList(Custom::getStatusArray()); ?>
    <?php } ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
