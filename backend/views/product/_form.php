<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Category;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="form-group field-product-purchase_price">
        <label for="productcategory-category_id" class="control-label col-sm-3">Categories</label>
        <div class="col-sm-6">
            <?php
            
            $data = Category::find()->getCategoryForSelect2();
            var_dump($data);
            exit;
            $data = [
                "red" => "red",
                "green" => "green",
                "blue" => "blue",
                "orange" => "orange",
                "white" => "white",
                "black" => [
                    "dark" => "dark",
                    "light" => "light",
                ],
                "purple" => "purple",
                "cyan" => "cyan",
                "teal" => "teal"
            ];

            echo Select2::widget([
                'model' => $model_product_category,
                'attribute' => 'category_id',
                'name' => 'category_id',
//        'data' => common\models\Tag::getOptions(),
                'data' => $data,
                'options' => [
                    'placeholder' => 'Select Category ...',
                    'class' => 'form-control',
                    'multiple' => true
                ],
                'theme' => 'bootstrap',
            ]);
            ?>
            <div class="help-block help-block-error"></div>
        </div>
    </div>


    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'display_name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'purchase_price')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'selling_price')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'is_private')->textInput() ?>

    <?php echo $form->field($model, 'created_date')->textInput() ?>

    <?php echo $form->field($model, 'updated_date')->textInput() ?>

    <?php echo $form->field($model, 'status')->textInput() ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
