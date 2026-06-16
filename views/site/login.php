<?php
<<<<<<< HEAD
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
$this->title = 'Login';
?>

<style>
.login-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    margin-top: -20px;
    padding-top: 80px;
    padding-bottom: 40px;
}
.login-card {
    max-width: 450px;
    margin: 0 auto;
    padding: 0 20px;
}
.login-form-box {
    background: white;
    border-radius: 20px;
    padding: 40px 35px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.35);
}
.login-input {
    width: 100%;
    padding: 13px 15px;
    border: 2px solid #e8e8e8;
    border-radius: 10px;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}
.login-input:focus {
    border-color: #4e73df;
    outline: none;
}
.login-btn {
    width: 100%;
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    color: white;
    padding: 14px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(78,115,223,0.4);
}
</style>

<div class="login-wrapper">
    <div class="login-card">

        <!-- Header -->
        <div style="text-align:center; margin-bottom:30px; color:white;">
            <div style="font-size:60px; margin-bottom:10px;">⛪</div>
            <h2 style="font-weight:800; margin:0; font-size:26px;">Faith Christian Church</h2>
            <p style="opacity:0.7; margin:8px 0 0 0; font-size:14px;">Sign in to your account</p>
        </div>

        <!-- Card -->
        <div class="login-form-box">

            <h4 style="text-align:center; color:#1a1a2e; margin:0 0 8px 0; font-weight:700; font-size:20px;">🔑 Welcome Back!</h4>
            <p style="text-align:center; color:#999; font-size:13px; margin:0 0 25px 0;">Enter your credentials to continue</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['style' => 'margin:0;']]); ?>

                <!-- Username -->
                <div style="margin-bottom:18px;">
                    <label style="font-size:13px; font-weight:600; color:#444; display:block; margin-bottom:6px;">👤 Username</label>
                    <?= $form->field($model, 'username', ['template' => '{input}{error}'])->textInput([
                        'placeholder' => 'Enter your username',
                        'class' => 'login-input',
                        'autofocus' => true
                    ]) ?>
                </div>

                <!-- Password -->
                <div style="margin-bottom:18px;">
                    <label style="font-size:13px; font-weight:600; color:#444; display:block; margin-bottom:6px;">🔒 Password</label>
                    <?= $form->field($model, 'password', ['template' => '{input}{error}'])->passwordInput([
                        'placeholder' => 'Enter your password',
                        'class' => 'login-input',
                    ]) ?>
                </div>

                <!-- Remember Me -->
                <div style="margin-bottom:22px;">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'label' => 'Remember me for 30 days',
                    ]) ?>
                </div>

                <!-- Submit -->
                <div style="margin-bottom:20px;">
                    <?= Html::submitButton('Login →', ['class' => 'login-btn']) ?>
                </div>

            <?php ActiveForm::end(); ?>

            <!-- Register Link -->
            <div style="text-align:center; color:#888; font-size:14px; border-top:1px solid #f0f0f0; padding-top:18px;">
                Don't have an account? 
                <?= Html::a('Register here', ['/site/register'], ['style' => 'color:#1cc88a; font-weight:700; text-decoration:none;']) ?>
            </div>
        </div>

        <!-- Bottom -->
        <p style="text-align:center; color:rgba(255,255,255,0.4); font-size:12px; margin-top:20px;">
            🙏 "I can do all things through Christ who strengthens me." — Philippians 4:13
        </p>

    </div>
</div>
=======

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login to your account';
$this->params['breadcrumbs'][] = $this->title;
$this->params['meta_description'] = 'Log in to access your Yii2 application account.';
$this->params['meta_keywords'] = 'yii, yii2, login, sign in, authentication';
$htmlIcon = <<<HTML
{label}<div class="input-group"><span class="input-group-text" aria-hidden="true">%s</span>{input}</div>{error}{hint}
HTML;
$labelOptions = ['class' => 'form-label fw-semibold small'];
?>
<div class="site-login d-flex align-items-center justify-content-center py-5">
    <div class="card border-0 overflow-hidden login-split-card">
        <div class="row g-0">

            <!-- Brand panel -->
            <div class="col-md-5 d-none d-md-flex login-brand-panel text-white">
                <div class="d-flex flex-column justify-content-between p-4 p-lg-5 w-100">
                    <div>
                        <?= Html::img(
                            Yii::getAlias('@web/images/yii3_full_white_for_dark.svg'),
                            [
                                'alt' => 'Yii Framework',
                                'class' => 'mb-4',
                                'height' => 40,
                            ],
                        ) ?>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-3 login-brand-title">
                            Welcome<br>Back
                        </h2>
                        <p class="opacity-75 mb-0 login-brand-text">
                            Log in to access your Yii2 application and manage your account.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form panel -->
            <div class="col-md-7">
                <div class="p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <!-- Mobile-only logo -->
                        <div class="d-md-none mb-3">
                            <?= Html::img(
                                Yii::getAlias('@web/images/yii3_full_black_for_light.svg'),
                                [
                                    'alt' => 'Yii Framework',
                                    'class' => 'login-mobile-logo',
                                    'height' => 36,
                                ],
                            ) ?>
                        </div>
                        <h1 class="h3 fw-bold mb-1"><?= Html::encode($this->title) ?></h1>
                        <p class="text-body-secondary small">Enter your credentials to continue</p>
                    </div>

                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <div class="mb-3">
                        <?= $form->field($model, 'username', [
                            'options' => ['class' => 'mb-0'],
                            'template' => sprintf($htmlIcon, '&#128100;'),
                            'inputOptions' => [
                                'class' => 'form-control',
                                'placeholder' => 'username',
                                'autofocus' => true,
                            ],
                        ])->textInput()->label('Your Username', $labelOptions) ?>
                    </div>

                    <div class="mb-3">
                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'mb-0'],
                            'template' => sprintf($htmlIcon, '&#128274;'),
                            'inputOptions' => [
                                'class' => 'form-control',
                                'placeholder' => 'Password',
                            ],
                        ])->passwordInput()->label('Your Password', $labelOptions) ?>
                    </div>

                    <div class="mb-4">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>

                    <div class="d-grid">
                        <?= Html::submitButton(
                            'Login',
                            [
                                'class' => 'btn login-btn btn-lg rounded-3 text-white',
                                'name' => 'login-button',
                            ],
                        ) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    

                </div>
            </div>

        </div>
    </div>
</div>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
