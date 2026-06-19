<?php
/**
 * Complete Profile view — Step 2 of 2
 * Place at: views/site/complete-profile.php
 *
 * @var yii\web\View $this
 * @var app\models\Members $model
 */
declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

$this->title  = 'Complete Your Profile';
?>

<div class="auth-wrap">
<div style="width:100%;max-width:520px;position:relative;z-index:1;">

    <a href="<?= Url::home() ?>" class="back-home">← Back to Home</a>

    <div class="auth-card auth-card-wide">

        <!-- Flash messages -->
        <?php foreach (Yii::$app->session->getAllFlashes() as $type => $msg): ?>
            <div class="auth-alert auth-alert-<?= $type === 'error' ? 'danger' : 'success' ?>">
                <?= Html::encode(is_array($msg) ? implode(' ', $msg) : $msg) ?>
            </div>
        <?php endforeach; ?>

        <div class="auth-logo">
            <div class="cross-badge">✝</div>
            <h1>Complete Your Profile</h1>
            <p>Step 2 of 2 — Tell us about yourself</p>
        </div>

        <!-- Progress steps -->
        <div class="steps-bar">
            <div class="step done"><div class="step-num">✓</div><span>Account</span></div>
            <div class="step-line"></div>
            <div class="step active"><div class="step-num">2</div><span>Profile</span></div>
        </div>

        <?php $form = ActiveForm::begin([
            'id'          => 'complete-profile-form',
            'fieldConfig' => [
                'template'     => "<div class=\"field-wrapper\">{label}\n{input}\n{error}</div>",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'help-block-error'],
            ],
        ]); ?>

            <div class="form-row-2">
                <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'First name'])->label('First Name') ?>
                <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Last name'])->label('Last Name') ?>
            </div>

            <?= $form->field($model, 'phone')->textInput(['placeholder' => '+255 7XX XXX XXX'])->label('Phone Number') ?>

            <div class="form-row-2">
                <?= $form->field($model, 'dob')->input('date')->label('Date of Birth') ?>
                <?= $form->field($model, 'gender')->dropDownList(
                    ['Male' => 'Male', 'Female' => 'Female'],
                    ['prompt' => 'Select gender', 'class' => 'form-select']
                )->label('Gender') ?>
            </div>

            <?= $form->field($model, 'address')->textInput(['placeholder' => 'Street, City'])->label('Home Address') ?>

            <?= $form->field($model, 'marital_status')->dropDownList(
                [
                    'Single'   => 'Single',
                    'Married'  => 'Married',
                    'Widowed'  => 'Widowed',
                    'Divorced' => 'Divorced',
                ],
                ['prompt' => 'Select status', 'class' => 'form-select']
            )->label('Marital Status') ?>

            <div class="auth-info-box auth-info-blue">
                ℹ️ You must be at least 18 years old to register as a member.
            </div>

            <button type="submit" class="auth-btn auth-btn-primary">
                🎉 Complete &amp; Go to Dashboard
            </button>

        <?php ActiveForm::end(); ?>

    </div><!-- /.auth-card -->
</div>
</div>