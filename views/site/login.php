<?php
/**
 * Sign In view
 * Place at: views/site/login.php
 *
 * @var yii\web\View $this
 * @var app\models\LoginForm $model
 */
declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

$this->title  = 'Sign In';
?>

<div class="auth-wrap">
<div style="width:100%;max-width:440px;position:relative;z-index:1;">

    <a href="<?= Url::home() ?>" class="back-home">← Back to Home</a>

    <div class="auth-card">

        <!-- Flash messages -->
        <?php foreach (Yii::$app->session->getAllFlashes() as $type => $msg): ?>
            <div class="auth-alert auth-alert-<?= $type === 'error' ? 'danger' : 'success' ?>">
                <?= Html::encode(is_array($msg) ? implode(' ', $msg) : $msg) ?>
            </div>
        <?php endforeach; ?>

        <div class="auth-logo">
            <div class="cross-badge">✝</div>
            <h1>Welcome Back</h1>
            <p>Sign in to access your church dashboard</p>
        </div>

        <?php $form = ActiveForm::begin([
            'id'          => 'login-form',
            'fieldConfig' => [
                'template'      => "<div class=\"field-wrapper\">{label}\n{input}\n{error}</div>",
                'labelOptions'  => ['class' => 'form-label'],
                'inputOptions'  => ['class' => 'form-control'],
                'errorOptions'  => ['class' => 'help-block-error'],
            ],
        ]); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus'   => true,
                'placeholder' => 'Username or email',
            ])->label('Username / Email') ?>

            <?= $form->field($model, 'password')->passwordInput([
                'placeholder' => '••••••••',
            ])->label('Password') ?>

            <div class="auth-check">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'label'        => 'Keep me signed in',
                    'labelOptions' => ['style' => 'margin:0;font-weight:400;text-transform:none;letter-spacing:0;color:var(--c-text-muted);font-size:.85rem;'],
                ])->label(false) ?>
            </div>

            <button type="submit" class="auth-btn auth-btn-primary" style="margin-top:.75rem;">
                🔑 Sign In
            </button>

        <?php ActiveForm::end(); ?>

        <div class="auth-divider">or</div>

        <a href="<?= Url::to(['/site/register']) ?>" class="auth-btn-outline-gold">
            ✨ Create a New Account
        </a>

        <div class="auth-footer-links">
            <a href="<?= Url::to(['/site/forgot-password']) ?>">Forgot password?</a>
            <a href="<?= Url::to(['/site/contact']) ?>">Contact Church</a>
        </div>

    </div><!-- /.auth-card -->
</div>
</div>