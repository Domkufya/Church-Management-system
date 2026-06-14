<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Events;
use app\models\Members;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_id')->dropDownList(
        ArrayHelper::map(Events::find()->all(), 'id', 'title'),
        ['prompt' => '--- Select Event ---']
    )->label('Select Event', ['style' => 'color: #333; font-weight: bold;']) ?>

    <?= $form->field($model, 'member_id')->dropDownList(
        ArrayHelper::map(Members::find()->all(), 'id', function($model) {
            return $model->first_name . ' ' . $model->last_name;
        }),
        ['prompt' => '--- Select Member Name ---']
    )->label('Select Member Name', ['style' => 'color: #333; font-weight: bold;']) ?>

    <?= $form->field($model, 'status')->hiddenInput(['value' => 'Present'])->label(false) ?>

    <div class="form-group" style="margin-top: 20px;">
        <?= Html::submitButton('Confirm Attendance', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>