<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Events $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<<<<<<< HEAD
=======
    <?= $form->field($model, 'event_date')->textInput() ?>

>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'Service' => 'Service', 'Meeting' => 'Meeting', 'Seminar' => 'Seminar', 'Conference' => 'Conference', 'Other' => 'Other', ], ['prompt' => '']) ?>

<<<<<<< HEAD
    <?= $form->field($model, 'event_date')->input('date') ?>
=======
    <?= $form->field($model, 'created_at')->textInput() ?>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<<<<<<< HEAD
    <?php foreach ($model->errors as $attribute => $errors): ?>
    <?php foreach ($errors as $error): ?>
        <div style="color:red;"><?= $attribute ?>: <?= $error ?></div>
    <?php endforeach; ?>
<?php endforeach; ?>
=======
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e

    <?php ActiveForm::end(); ?>

</div>
