<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Submit Prayer Request';
?>

<div class="member-create-prayer">

    <div class="card shadow-lg border-0" style="border-radius: 16px; max-width: 750px; margin: 30px auto; overflow: hidden;">

        <div class="card-header text-white text-center" style="padding: 30px; border: none; background: linear-gradient(135deg, #4f8ef7, #7b2ff7);">
            <div style="font-size: 3rem; margin-bottom: 10px;">🙏</div>
            <h3 class="mb-1 text-white" style="font-weight: 700;">Submit New Prayer Request</h3>
            <p class="mb-0" style="font-size: 0.95rem; opacity: 0.85;">Please fill in this form carefully so your request can be attended to.</p>
        </div>

        <div class="card-body" style="padding: 40px; background-color: #ffffff;">

            <?php $form = ActiveForm::begin(); ?>

            <!-- Prayer Request -->
            <div class="mb-4">
                <label style="color: #1a1a1a; font-weight: 600; font-size: 0.95rem; display:block; margin-bottom:8px;">Prayer Request Details</label>
                <?= $form->field($model, 'request', [
                    'template' => "{input}\n{error}",
                ])->textarea([
                    'rows' => 6,
                    'style' => 'border: 2px solid #e0e0e0; border-radius: 10px; color: #1a1a1a !important; background-color: #ffffff !important; font-size: 1rem; padding: 15px; width: 100%;',
                    'placeholder' => 'Write your prayer request here in detail...'
                ]) ?>
            </div>

            <!-- Anonymous -->
            <div class="mb-4">
                <label style="color: #1a1a1a; font-weight: 600; font-size: 0.95rem; display:block; margin-bottom:8px;">Submit Anonymously?</label>
                <?= $form->field($model, 'is_anonymous', [
                    'template' => "{input}\n{error}",
                ])->dropDownList([
                    0 => 'No — Show My Name',
                    1 => 'Yes — Send Anonymously',
                ], [
                    'style' => 'border: 2px solid #e0e0e0; border-radius: 10px; color: #1a1a1a !important; background-color: #ffffff !important; padding: 10px; width: 100%; font-size: 1rem;'
                ]) ?>
            </div>

            <!-- Buttons -->
            <div class="mt-4 d-flex flex-column gap-2">
                <?= Html::submitButton('🙏 SUBMIT PRAYER REQUEST', [
                    'class' => 'btn btn-lg w-100',
                    'style' => 'background: linear-gradient(135deg, #4f8ef7, #7b2ff7); color: #fff; border-radius: 10px; font-weight: 700; padding: 14px; font-size: 1.1rem; border: none;'
                ]) ?>
                <?= Html::a('← Cancel', ['/member/prayers'], [
                    'class' => 'btn btn-link text-center mt-2',
                    'style' => 'color: #6c757d; text-decoration: none; font-weight: 500;'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>

<style>
textarea, select {
    color: #1a1a1a !important;
    background-color: #ffffff !important;
}
textarea:focus, select:focus {
    border-color: #4f8ef7 !important;
    box-shadow: 0 0 0 4px rgba(79, 142, 247, 0.15) !important;
    color: #1a1a1a !important;
    background-color: #ffffff !important;
}
</style>