<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PrayerRequests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="prayer-requests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'request')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_anonymous')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Pending' => 'Pending', 'Prayed' => 'Prayed', 'Answered' => 'Answered', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
