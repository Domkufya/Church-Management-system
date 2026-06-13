<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrayerRequests */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prayer-request-form">

    <div class="card shadow-lg border-0" style="border-radius: 16px; background-color: #ffffff !important; max-width: 750px; margin: 30px auto; overflow: hidden;">
        
        <div class="card-header text-white text-center" style="padding: 30px; border: none; background: linear-gradient(135deg, #4f8ef7, #7b2ff7);">
            <div style="font-size: 3rem; margin-bottom: 10px;">🙏</div>
            <h3 class="mb-1 text-white" style="font-weight: 700;">Submit New Prayer Request</h3>
            <p class="mb-0" style="font-size: 0.95rem; opacity: 0.85;">Please fill in this form carefully so your request can be attended to.</p>
        </div>

        <div class="card-body" style="padding: 40px; background-color: #ffffff;">

            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'needs-validation'],
                'fieldConfig' => [
                    'labelOptions' => ['class' => 'form-label fw-bold', 'style' => 'color: #1a1a1a; font-size: 0.95rem; margin-bottom: 8px;'],
                    'inputOptions' => ['class' => 'form-control form-control-lg', 'style' => 'border: 2px solid #e0e0e0; color: #1a1a1a; background-color: #ffffff; font-size: 1rem; padding: 12px; border-radius: 10px;'],
                ],
            ]); ?>

            <!-- Member ID -->
            <div class="mb-4">
                <?= $form->field($model, 'member_id', [
                    'template' => "{label}\n<div class='input-group'><span class='input-group-text' style='border: 2px solid #e0e0e0; border-right: none; border-radius: 10px 0 0 10px; background:#f8f9fa;'>👤</span>{input}</div>\n{error}"
                ])->textInput(['placeholder' => 'Enter your Member ID (e.g. 13)', 'autocomplete' => 'off', 'style' => 'border-radius: 0 10px 10px 0 !important;']) ?>
            </div>

            <!-- Anonymous and Status -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <?= $form->field($model, 'is_anonymous', [
                        'template' => "{label}\n<div class='input-group'><span class='input-group-text' style='border: 2px solid #e0e0e0; border-right: none; border-radius: 10px 0 0 10px; background:#f8f9fa;'>🙈</span>{input}</div>\n{error}"
                    ])->dropDownList([
                        0 => 'No — Show My Name',
                        1 => 'Yes — Send Anonymously',
                    ], ['style' => 'border: 2px solid #e0e0e0; color: #1a1a1a; background-color: #ffffff; border-radius: 0 10px 10px 0;']) ?>
                </div>
                
                <div class="col-md-6 mb-4">
                    <?= $form->field($model, 'status', [
                        'template' => "{label}\n<div class='input-group'><span class='input-group-text' style='border: 2px solid #e0e0e0; border-right: none; border-radius: 10px 0 0 10px; background:#f8f9fa;'>📋</span>{input}</div>\n{error}"
                    ])->dropDownList([
                        'Pending'  => '🕐 Pending',
                        'Prayed'   => '🙏 Prayed',
                        'Answered' => '✅ Answered',
                    ], ['style' => 'border: 2px solid #e0e0e0; color: #1a1a1a; background-color: #ffffff; border-radius: 0 10px 10px 0;']) ?>
                </div>
            </div>

            <!-- Prayer Request Details -->
            <div class="mb-4">
                <?= $form->field($model, 'request', [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label fw-bold', 'style' => 'color: #1a1a1a; font-size: 0.95rem;'],
                ])->textarea([
                    'rows' => 6,
                    'style' => 'border: 2px solid #e0e0e0; border-radius: 10px; color: #1a1a1a; background-color: #ffffff; font-size: 1rem; padding: 15px; width: 100%;',
                    'placeholder' => 'Write your prayer request here in detail...'
                ]) ?>
            </div>

            <!-- Buttons -->
            <div class="mt-4 d-flex flex-column gap-2">
                <?= Html::submitButton('🙏 SUBMIT PRAYER REQUEST', [
                    'class' => 'btn btn-lg w-100',
                    'style' => 'background: linear-gradient(135deg, #4f8ef7, #7b2ff7); color: #fff; border-radius: 10px; font-weight: 700; padding: 14px; font-size: 1.1rem; border: none;'
                ]) ?>
                <?= Html::a('← Cancel', ['index'], [
                    'class' => 'btn btn-link text-center mt-2',
                    'style' => 'color: #6c757d; text-decoration: none; font-weight: 500;'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>

<style>
.form-control:focus {
    border-color: #4f8ef7 !important;
    box-shadow: 0 0 0 4px rgba(79, 142, 247, 0.15) !important;
}
</style>