<?php
/**
 * Forgot Password view
 * Place at: views/site/forgot-password.php
 *
 * @var yii\web\View $this
 * @var string|null  $token      Plain-text token shown after generation
 * @var string|null  $tokenUser  Username the token was generated for
 */
declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;

$this->title  = 'Forgot Password';
$hasToken     = !empty($token);
?>

<div class="auth-wrap">
<div style="width:100%;max-width:440px;position:relative;z-index:1;">

    <a href="<?= Url::to(['/site/login']) ?>" class="back-home">← Back to Sign In</a>

    <div class="auth-card">

        <!-- Flash messages (e.g. "email not found" error) -->
        <?php foreach (Yii::$app->session->getAllFlashes() as $type => $msg): ?>
            <div class="auth-alert auth-alert-<?= $type === 'error' ? 'danger' : 'success' ?>">
                <?= Html::encode(is_array($msg) ? implode(' ', $msg) : $msg) ?>
            </div>
        <?php endforeach; ?>

        <div class="auth-logo">
            <div class="cross-badge"><?= $hasToken ? '✓' : '🔐' ?></div>
            <h1><?= $hasToken ? 'Your Token' : 'Forgot Password' ?></h1>
            <p>
                <?= $hasToken
                    ? 'Copy the token below — use it as your temporary password'
                    : 'Enter your email address to generate a temporary password token'
                ?>
            </p>
        </div>

        <?php if ($hasToken): ?>
        <!-- ══════════ TOKEN GENERATED STATE ══════════ -->

        <?php if ($tokenUser): ?>
            <p style="text-align:center;font-size:.82rem;color:var(--c-text-muted);margin-bottom:.5rem;">
                Account: <strong><?= Html::encode($tokenUser) ?></strong>
            </p>
        <?php endif; ?>

        <div class="auth-info-box auth-info-green token-box">
            <div class="token-label">🔑 Temporary Password Token</div>
            <div class="token-value" id="tokenVal"><?= Html::encode($token) ?></div><br>
            <button class="copy-btn" id="copyBtn" onclick="copyToken()">
                📋 Copy Token
            </button>
        </div>

        <div class="auth-info-box auth-info-gold" style="margin-top:.5rem;">
            <strong>How to use this token:</strong>
            <ol style="margin:.4rem 0 0 1.1rem;padding:0;line-height:1.8;">
                <li>Copy the token above.</li>
                <li>Go to <strong>Sign In</strong> and enter your username/email.</li>
                <li>Paste this token as your <strong>password</strong>.</li>
                <li>Once logged in, go to <strong>My Profile → Edit Profile</strong> and set a permanent password.</li>
            </ol>
        </div>

        <a href="<?= Url::to(['/site/login']) ?>" class="auth-btn auth-btn-primary" style="margin-top:1rem;">
            🔑 Go to Sign In
        </a>

        <script>
        function copyToken() {
            const val = document.getElementById('tokenVal').textContent.trim();
            navigator.clipboard.writeText(val).then(function() {
                const btn = document.getElementById('copyBtn');
                btn.textContent = '✅ Copied!';
                btn.classList.add('copied');
                setTimeout(function() {
                    btn.innerHTML = '📋 Copy Token';
                    btn.classList.remove('copied');
                }, 2500);
            }).catch(function() {
                // Fallback for browsers without clipboard API
                const ta = document.createElement('textarea');
                ta.value = val;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                document.getElementById('copyBtn').textContent = '✅ Copied!';
            });
        }
        </script>

        <?php else: ?>
        <!-- ══════════ REQUEST FORM STATE ══════════ -->

        <form method="POST" action="<?= Url::to(['/site/forgot-password']) ?>" novalidate>
            <input type="hidden"
                   name="<?= Yii::$app->request->csrfParam ?>"
                   value="<?= Yii::$app->request->csrfToken ?>">

            <div class="field-wrapper">
                <label class="form-label" for="fp-email">Email Address</label>
                <input type="email"
                       id="fp-email"
                       name="email"
                       required
                       autofocus
                       class="form-control"
                       placeholder="your@email.com">
            </div>

            <div class="auth-info-box auth-info-blue">
                ℹ️ A temporary password token will be generated and shown on-screen.
                Copy it, use it to sign in, then update your password in your profile.
            </div>

            <button type="submit" class="auth-btn auth-btn-primary">
                🔐 Generate Password Token
            </button>
        </form>

        <div class="auth-footer-links">
            <a href="<?= Url::to(['/site/login']) ?>">← Sign In</a>
            <a href="<?= Url::to(['/site/register']) ?>">Create Account</a>
        </div>

        <?php endif; ?>

    </div><!-- /.auth-card -->
</div>
</div>