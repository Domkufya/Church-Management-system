<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
$this->title = 'Login';
?>
<?php

$htmlIcon = <<<HTML
{label}<div class="input-group"><span class="input-group-text" aria-hidden="true">%s</span>{input}</div>{error}{hint}
HTML;

$labelOptions = ['class' => 'form-label fw-semibold small'];

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
