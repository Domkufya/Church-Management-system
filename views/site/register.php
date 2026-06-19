<?php
/**
 * Create Account view — Step 1 of 2
 * Place at: views/site/register.php
 *
 * @var yii\web\View $this
 * @var app\models\User $model
 */
declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

$this->title  = 'Create Account';
?>

<div class="auth-wrap">
<div style="width:100%;max-width:480px;position:relative;z-index:1;">

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
            <h1>Create Account</h1>
            <p>Step 1 of 2 — Set up your login credentials</p>
        </div>

        <!-- Progress steps -->
        <div class="steps-bar">
            <div class="step active"><div class="step-num">1</div><span>Account</span></div>
            <div class="step-line"></div>
            <div class="step"><div class="step-num">2</div><span>Profile</span></div>
        </div>

        <?php $form = ActiveForm::begin([
            'id'          => 'register-form',
            'fieldConfig' => [
                'template'     => "<div class=\"field-wrapper\">{label}\n{input}\n{error}</div>",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'help-block-error'],
            ],
        ]); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus'   => true,
                'placeholder' => 'Choose a username',
            ])->label('Username') ?>

            <?= $form->field($model, 'email')->input('email', [
                'placeholder' => 'your@email.com',
            ])->label('Email Address') ?>

            <?= $form->field($model, 'password_hash')->passwordInput([
                'id'          => 'pw-input',
                'placeholder' => 'Min. 8 characters',
            ])->label('Password') ?>

            <!-- Password strength indicator -->
            <div style="margin:-0.5rem 0 1rem;">
                <div id="pw-strength-bar" class="pw-strength-bar"></div>
                <span id="pw-strength-label" class="pw-strength-label"></span>
            </div>

            <div class="auth-info-box auth-info-gold">
                🔐 After creating your account you will be taken to complete your church member profile.
            </div>

            <button type="submit" class="auth-btn auth-btn-gold">
                ✨ Create Account &amp; Continue →
            </button>

        <?php ActiveForm::end(); ?>

        <div class="auth-divider">Already have an account?</div>

        <a href="<?= Url::to(['/site/login']) ?>" class="auth-btn-outline">
            🔑 Sign In
        </a>

        <div class="auth-footer-links">
            <a href="<?= Url::to(['/site/forgot-password']) ?>">Forgot password?</a>
            <a href="<?= Url::to(['/site/contact']) ?>">Contact Church</a>
        </div>

    </div><!-- /.auth-card -->
</div>
</div>

<script>
(function() {
    const input = document.getElementById('pw-input');
    const bar   = document.getElementById('pw-strength-bar');
    const lbl   = document.getElementById('pw-strength-label');
    if (!input) return;
    input.addEventListener('input', function() {
        const v = this.value;
        let score = 0;
        if (v.length >= 8)           score++;
        if (/[A-Z]/.test(v))         score++;
        if (/[0-9]/.test(v))         score++;
        if (/[^A-Za-z0-9]/.test(v))  score++;
        const colors = ['#ef4444','#f97316','#f59e0b','#10b981'];
        const labels = ['Weak','Fair','Good','Strong'];
        const widths = ['25%','50%','75%','100%'];
        if (!v.length) { bar.style.width='0'; lbl.textContent=''; return; }
        const i = Math.max(0, score - 1);
        bar.style.width      = widths[i];
        bar.style.background = colors[i];
        lbl.textContent      = labels[i];
        lbl.style.color      = colors[i];
    });
})();
</script>