<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Register';
?>

<div style="min-height:100vh; background:linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); margin-top:-20px; padding-top:80px; padding-bottom:40px;">

    <div style="max-width:480px; margin:0 auto; padding:0 20px;">

        <!-- Logo & Title -->
        <div style="text-align:center; margin-bottom:30px; color:white;">
            <div style="font-size:55px;">⛪</div>
            <h2 style="font-weight:800; margin:10px 0 5px 0;">Faith Christian Church</h2>
            <p style="opacity:0.7; margin:0; font-size:14px;">Create your account to get started</p>
        </div>

        <!-- Form Card -->
        <div style="background:white; border-radius:20px; padding:35px 30px; box-shadow:0 20px 60px rgba(0,0,0,0.3);">

            <h4 style="text-align:center; color:#1a1a2e; margin:0 0 25px 0; font-weight:700;">📝 Register</h4>

            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; margin-bottom:15px; font-size:14px;">
                    ✅ <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(['options' => ['style' => 'margin:0;']]); ?>

                <div style="margin-bottom:18px;">
                    <label style="font-size:13px; font-weight:600; color:#555; display:block; margin-bottom:6px;">👤 Username</label>
                    <?= $form->field($model, 'username', ['template' => '{input}{error}'])->textInput([
                        'placeholder' => 'Choose a username',
                        'style' => 'width:100%; padding:12px 15px; border:2px solid #e0e0e0; border-radius:10px; font-size:14px; outline:none; box-sizing:border-box;',
                        'autofocus' => true
                    ]) ?>
                </div>

                <div style="margin-bottom:18px;">
                    <label style="font-size:13px; font-weight:600; color:#555; display:block; margin-bottom:6px;">📧 Email</label>
                    <?= $form->field($model, 'email', ['template' => '{input}{error}'])->input('email', [
                        'placeholder' => 'Your email address',
                        'style' => 'width:100%; padding:12px 15px; border:2px solid #e0e0e0; border-radius:10px; font-size:14px; outline:none; box-sizing:border-box;',
                    ]) ?>
                </div>

<<<<<<< HEAD
=======
                <div style="margin-bottom:18px;">
                    <label style="font-size:13px; font-weight:600; color:#555; display:block; margin-bottom:6px;">🎭 Role / Position</label>
                    <?= $form->field($model, 'role', ['template' => '{input}{error}'])->dropDownList([
                        'member' => 'Member',
                        'pastor' => 'Pastor',
                        'secretary' => 'Secretary',
                        'treasurer' => 'Treasurer',
                        'admin' => 'Administrator',
                    ], [
                        'style' => 'width:100%; padding:12px 15px; border:2px solid #e0e0e0; border-radius:10px; font-size:14px; outline:none; box-sizing:border-box; background:white;',
                    ]) ?>
                </div>

>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
                <div style="margin-bottom:25px;">
                    <label style="font-size:13px; font-weight:600; color:#555; display:block; margin-bottom:6px;">🔒 Password</label>
                    <?= $form->field($model, 'password_hash', ['template' => '{input}{error}'])->passwordInput([
                        'placeholder' => 'Create a strong password',
                        'style' => 'width:100%; padding:12px 15px; border:2px solid #e0e0e0; border-radius:10px; font-size:14px; outline:none; box-sizing:border-box;',
                    ])->label(false) ?>
                </div>

                <div style="margin-bottom:20px;">
                    <?= Html::submitButton('Create Account →', [
                        'style' => 'width:100%; background:linear-gradient(135deg, #1cc88a 0%, #17a673 100%); color:white; padding:14px; border:none; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; box-shadow:0 4px 15px rgba(28,200,138,0.4);'
                    ]) ?>
                </div>

            <?php ActiveForm::end(); ?>

            <div style="text-align:center; color:#888; font-size:14px;">
                Already have an account? <?= Html::a('Login here', ['/site/login'], ['style' => 'color:#4e73df; font-weight:600; text-decoration:none;']) ?>
            </div>
        </div>

        <!-- Footer note -->
        <p style="text-align:center; color:rgba(255,255,255,0.5); font-size:12px; margin-top:20px;">
            🙏 God bless you as you join our community
        </p>
    </div>
</div>