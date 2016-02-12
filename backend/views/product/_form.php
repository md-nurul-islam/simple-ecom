<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Category;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group field-product-purchase_price">
        <label for="productcategory-category_id" class="control-label col-sm-3">Categories</label>
        <div class="col-sm-6">
            <?php
            $data = Category::find()->getCategoryForSelect2();
            $data_product_categories = [];
            if (!empty($model->id) && !empty($model->productCategories)) {
                $productCategories = $model->productCategories;
                foreach ($productCategories as $pc) {
                    $data_product_categories[] = $pc->category->id;
                }
                $model_product_category->category_id = $data_product_categories;
            }
            
            echo Select2::widget([
                'model' => $model_product_category,
                'attribute' => 'category_id',
                'name' => 'category_id',
                'data' => $data,
                'options' => [
                    'placeholder' => 'Select Category ...',
                    'class' => 'form-control',
                    'multiple' => true
                ],
                'theme' => 'bootstrap',
            ]);
            ;
            ?>
            <div class="help-block help-block-error"></div>
        </div>
    </div>

    <?php
    $data_manufacturer = ArrayHelper::map($model_manufacturer::find()->where(['status' => 0])->asArray()->all(), 'id', 'name');

    if (!empty($model->id) && !empty($model->productManufacturers)) {
        $model_product_manufacturer->manufacturer_id = $model->productManufacturers[0]->manufacturer_id;
    }

    echo $form->field($model_product_manufacturer, 'manufacturer_id')->dropDownList($data_manufacturer, [
        'prompt' => 'Select Manufacturer',
    ]);
    ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?php echo $form->field($model, 'display_name')->textInput(['maxlength' => true]); ?>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 6]); ?>

    <?php echo $form->field($upload_model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']); ?>

    <?php echo $form->field($model, 'purchase_price')->textInput(['maxlength' => true]); ?>

    <?php echo $form->field($model, 'selling_price')->textInput(['maxlength' => true]); ?>

    <?php echo $form->field($model, 'is_private')->checkbox(); ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php
    ActiveForm::end();
    ;
    ?>

</div>
