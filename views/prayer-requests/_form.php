<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrayerRequests */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prayer-request-form">

    <div class="card shadow-lg border-0" style="border-radius: 16px; background-color: #ffffff !important; max-width: 750px; margin: 30px auto; overflow: hidden;">
        
        <div class="card-header bg-primary text-white text-center" style="padding: 25px; border: none;">
            <h3 class="mb-1 text-white" style="font-weight: 700; letter-spacing: 0.5px;">
                <i class="fas fa-hand-holding-heart animate-pulse"></i> Submit New Prayer Request
            </h3>
            <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Jaza fomu hii kwa umakini ili ombi lako lishughulikiwe.</p>
        </div>

        <div class="card-body" style="padding: 40px; background-color: #ffffff !important;">

            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'needs-validation'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class='input-group'>{input}</div>\n{error}",
                    // Kulazimisha lebo zote ziwe nyeusi nzito na zisomeke vizuri sana
                    'labelOptions' => ['class' => 'form-label fw-bold', 'style' => 'color: #1a1a1a !important; font-size: 0.95rem; margin-bottom: 8px; font-weight: 600; display: inline-block;'],
                    // Kulazimisha visanduku viwe na mpaka (border) wa kijivu na maandishi ya ndani yawe meusi
                    'inputOptions' => ['class' => 'form-control form-control-lg', 'style' => 'border: 2px solid #e0e0e0 !important; color: #1a1a1a !important; background-color: #ffffff !important; font-size: 1rem; padding: 12px;'],
                ],
            ]); ?>

            <div class="mb-4">
                <?= $form->field($model, 'member_id', [
                    'template' => "{label}\n<div class='input-group'><span class='input-group-text bg-light text-secondary' style='border: 2px solid #e0e0e0; border-right: none;'><i class='fas fa-user-tag'></i></span>{input}</div>\n{error}"
                ])->textInput(['placeholder' => 'Example: M-1024', 'autocomplete' => 'off']) ?>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <?= $form->field($model, 'is_anonymous', [
                        'template' => "{label}\n<div class='input-group'><span class='input-group-text bg-light text-secondary' style='border: 2px solid #e0e0e0; border-right: none;'><i class='fas fa-user-secret'></i></span>{input}</div>\n{error}"
                    ])->dropDownList([
                        0 => 'No (Show My Name / Onyesha Jina)',
                        1 => 'Yes (Send Anonymously / Kwa Siri)',
                    ], ['style' => 'border: 2px solid #e0e0e0 !important; color: #1a1a1a !important; background-color: #ffffff !important; height: auto;']) ?>
                </div>
                
                <div class="col-md-6 mb-4">
                    <?= $form->field($model, 'status', [
                        'template' => "{label}\n<div class='input-group'><span class='input-group-text bg-light text-secondary' style='border: 2px solid #e0e0e0; border-right: none;'><i class='fas fa-sync-alt'></i></span>{input}</div>\n{error}"
                    ])->dropDownList([
                        'Pending' => 'Pending (Inasubiri)',
                        'Reviewed' => 'Under Review (Inapitiwa)',
                        'Answered' => 'Answered (Imejibiwa)',
                    ], ['style' => 'border: 2px solid #e0e0e0 !important; color: #1a1a1a !important; background-color: #ffffff !important; height: auto;']) ?>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold" style="color: #1a1a1a !important; font-size: 0.95rem; margin-bottom: 8px; font-weight: 600;">Prayer Request Details</label>
                <?= $form->field($model, 'request', [
                    'template' => "{input}\n{error}",
                ])->textarea([
                    'rows' => 6, 
                    'style' => 'border: 2px solid #e0e0e0 !important; border-radius: 10px !important; color: #1a1a1a !important; background-color: #ffffff !important; font-size: 1rem; padding: 15px;', 
                    'placeholder' => 'Andika hapa mambo yote unayoomba yafanyiwe kazi...'
                ]) ?>
            </div>

            <div class="form-group mt-5 d-flex flex-column gap-2">
                <?= Html::submitButton('<i class="fas fa-paper-plane me-2"></i> WASILISHA MAOMBI RASMI', [
                    'class' => 'btn btn-primary btn-lg w-100',
                    'style' => 'border-radius: 10px; font-weight: 700; letter-spacing: 0.5px; padding: 14px 20px; font-size: 1.1rem; box-shadow: 0 4px 6px rgba(0, 123, 255, 0.15); transition: all 0.3s ease;'
                ]) ?>
                <?= Html::a('Ghairi (Cancel)', ['index'], [
                    'class' => 'btn btn-link text-center mt-2', 
                    'style' => 'color: #6c757d !important; text-decoration: none; font-weight: 500; font-size: 0.95rem;'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>

<style>
    .input-group-text {
        border-radius: 10px 0 0 10px !important;
        font-size: 1.1rem;
    }
    .form-control {
        border-radius: 0 10px 10px 0 !important;
    }
    /* Mfumo ukiguswa (Focus State) ulete rangi ya bluu safi */
    .form-control:focus {
        border-color: #007bff !important;
        box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.15) !important;
        background-color: #ffffff !important;
        color: #1a1a1a !important;
    }
    .input-group:focus-within .input-group-text {
        border-color: #007bff !important;
        background-color: #e9ecef !important;
        color: #007bff !important;
    }
    /* Uhuishaji mdogo wa icon ya kichwa (Pulse effect) */
    .animate-pulse {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.08); }
        100% { transform: scale(1); }
    }
</style>