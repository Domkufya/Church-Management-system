<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-form">

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'gender')->dropDownList([
    'Male' => 'Male',
    'Female' => 'Female'
], ['prompt' => 'Select Gender']) ?>

<?= $form->field($model, 'dob')->textInput(['type' => 'date']) ?>

<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>

<?= $form->field($model, 'marital_status')->dropDownList([
    'Single' => 'Single',
    'Married' => 'Married',
    'Widowed' => 'Widowed',
    'Divorced' => 'Divorced'
], ['prompt' => 'Select Status']) ?>

<?= $form->field($model, 'status')->dropDownList([
    'Active' => 'Active',
    'Inactive' => 'Inactive'
]) ?>

<?= $form->field($model, 'photo')->fileInput() ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>