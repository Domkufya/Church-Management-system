<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Offerings $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="offerings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'Tithe' => 'Tithe', 'Offering' => 'Offering', 'Donation' => 'Donation', 'Fundraising' => 'Fundraising', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'payment_method')->dropDownList([ 'Cash' => 'Cash', 'Mobile Money' => 'Mobile Money', 'Bank Transfer' => 'Bank Transfer', 'Cheque' => 'Cheque', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'offering_date')->textInput() ?>

    <?= $form->field($model, 'received_by')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
