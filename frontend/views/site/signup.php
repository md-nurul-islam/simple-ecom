<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container container-fluid">
    <div class="site-signup">
        <h1><?php echo Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to signup:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?php echo $form->field($model, 'name'); ?>
                <?php echo $form->field($model, 'email'); ?>
                <?php echo $form->field($model, 'address'); ?>
                <?php echo $form->field($model, 'contact_number'); ?>
                <?php echo $form->field($model, 'password')->passwordInput(); ?>
                <?php echo $form->field($model, 'confirm_password')->passwordInput(); ?>
                <?php echo $form->field($model, 'is_affiliate')->checkbox(); ?>

                <?php if (isset($_GET['ref'])) { ?>
                    <input type="hidden" id="signupform-referrar_id" name="SignupForm[referrar_id]" value="<?php echo $_GET['ref']; ?>">
                <?php } ?>

                <div class="form-group">
                    <?php echo Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>