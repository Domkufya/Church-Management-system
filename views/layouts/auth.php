<?php
/**
 * Auth layout — full-page layout for login, register, forgot-password, complete-profile
 * Place at: views/layouts/auth.php
 *
 * In SiteController, set:  $this->layout = '/layouts/auth';
 * (single slash = relative to @app/views, NOT double slash)
 *
 * @var yii\web\View $this
 * @var string $content
 */
declare(strict_types=1);

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-bs-theme="light">
<head>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title ?? Yii::$app->name) ?> | <?= Html::encode(Yii::$app->name) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    /* ══════════════════════════════════════════
       AUTH LAYOUT — Design tokens + Components
       Place in views/layouts/auth.php
       ══════════════════════════════════════════ */
    :root {
        --c-primary:    #1E3A8A;
        --c-primary-dk: #162d6e;
        --c-primary-md: #2563EB;
        --c-primary-lt: #3B82F6;
        --c-gold:       #F59E0B;
        --c-gold-dk:    #D97706;
        --c-gold-lt:    #FEF3C7;
        --c-bg:         #F1F5F9;
        --c-surface:    #FFFFFF;
        --c-border:     #E2E8F0;
        --c-text:       #0F172A;
        --c-text-muted: #64748B;
        --c-success:    #10B981;
        --c-danger:     #EF4444;
    }
    *, *::before, *::after { box-sizing: border-box; }
    html, body { height: 100%; margin: 0; padding: 0; }
    body {
        font-family: 'Inter', sans-serif;
        background: var(--c-bg);
        color: var(--c-text);
        font-size: 0.9rem;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
    }
    h1,h2,h3 { font-family: 'Playfair Display', serif; line-height: 1.25; }
    a { text-decoration: none; }

    /* Wrap */
    .auth-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(160deg, #162d6e 0%, #1E3A8A 45%, #2563EB 100%);
        padding: 2rem 1rem;
        position: relative;
    }
    .auth-wrap::before {
        content: '✝';
        position: fixed;
        bottom: -6rem; left: -4rem;
        font-size: 36rem;
        color: rgba(255,255,255,0.03);
        line-height: 1;
        pointer-events: none;
        user-select: none;
        font-family: serif;
    }

    /* Card */
    .auth-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 12px 48px rgba(15,23,42,0.22);
        padding: 2.8rem 2.5rem 2.2rem;
        width: 100%;
        max-width: 440px;
        position: relative;
        z-index: 1;
    }
    .auth-card-wide { max-width: 520px; }
    [data-bs-theme="dark"] .auth-card { background: #1e293b; color: #e2e8f0; }

    /* Logo */
    .auth-logo { text-align: center; margin-bottom: 1.6rem; }
    .auth-logo .cross-badge {
        display: inline-flex; align-items: center; justify-content: center;
        width: 58px; height: 58px; background: var(--c-primary);
        border-radius: 50%; font-size: 1.6rem; color: #fff;
        margin-bottom: .75rem; box-shadow: 0 4px 16px rgba(30,58,138,.3);
    }
    .auth-logo h1 { font-size: 1.55rem; color: var(--c-primary); margin: 0 0 .25rem; }
    .auth-logo p  { font-size: .83rem; color: var(--c-text-muted); margin: 0; }

    /* Form */
    .form-label {
        display: block;
        font-size: .82rem; font-weight: 600; color: var(--c-text-muted);
        text-transform: uppercase; letter-spacing: .07em; margin-bottom: .35rem;
    }
    .form-control, .form-select {
        border-radius: 8px; border: 1.5px solid var(--c-border);
        font-size: .92rem; padding: .65rem .9rem; width: 100%;
        transition: border-color .18s, box-shadow .18s;
        background: #fff; color: var(--c-text); outline: none;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--c-primary-md);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    }
    [data-bs-theme="dark"] .form-control,
    [data-bs-theme="dark"] .form-select { background: #0f172a; border-color: #334155; color: #e2e8f0; }
    .field-wrapper { margin-bottom: 1rem; }
    .help-block-error { font-size: .78rem; color: var(--c-danger); margin-top: .25rem; display: block; }

    /* Buttons */
    .auth-btn {
        display: flex; align-items: center; justify-content: center; gap: .5rem;
        width: 100%; padding: .8rem 1.5rem; border: none; border-radius: 10px;
        font-size: .95rem; font-weight: 700; cursor: pointer; margin-top: .25rem;
        transition: background .18s, transform .15s, box-shadow .18s;
        text-decoration: none;
    }
    .auth-btn-primary { background: var(--c-primary); color: #fff; }
    .auth-btn-primary:hover { background: var(--c-primary-dk); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(30,58,138,.3); color: #fff; }
    .auth-btn-gold { background: var(--c-gold); color: #fff; }
    .auth-btn-gold:hover { background: var(--c-gold-dk); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(245,158,11,.35); color: #fff; }

    .auth-btn-outline {
        display: block; text-align: center; padding: .7rem;
        border: 1.5px solid var(--c-primary); border-radius: 10px;
        color: var(--c-primary); font-size: .88rem; font-weight: 600;
        transition: background .18s, color .18s;
    }
    .auth-btn-outline:hover { background: var(--c-primary); color: #fff; }
    .auth-btn-outline-gold {
        display: block; text-align: center; padding: .7rem;
        border: 1.5px solid var(--c-gold); border-radius: 10px;
        color: var(--c-gold-dk); font-size: .88rem; font-weight: 600;
        transition: background .18s, color .18s;
    }
    .auth-btn-outline-gold:hover { background: var(--c-gold); color: #fff; }

    /* Divider */
    .auth-divider {
        text-align: center; font-size: .8rem; color: var(--c-text-muted);
        margin: 1.2rem 0; position: relative;
    }
    .auth-divider::before, .auth-divider::after {
        content: ''; position: absolute; top: 50%; width: 38%; height: 1px; background: var(--c-border);
    }
    .auth-divider::before { left: 0; } .auth-divider::after { right: 0; }

    /* Footer links */
    .auth-footer-links { display: flex; justify-content: space-between; margin-top: 1.3rem; font-size: .8rem; }
    .auth-footer-links a { color: var(--c-primary-md); }
    .auth-footer-links a:hover { text-decoration: underline; }

    /* Back home */
    .back-home {
        display: inline-flex; align-items: center; gap: .3rem;
        font-size: .78rem; color: rgba(255,255,255,.65); margin-bottom: 1rem;
        transition: color .15s; position: relative; z-index: 1;
    }
    .back-home:hover { color: #fff; }

    /* Steps */
    .steps-bar { display: flex; align-items: center; margin-bottom: 1.8rem; }
    .step { display: flex; align-items: center; gap: .4rem; font-size: .75rem; font-weight: 600; color: var(--c-text-muted); }
    .step-num { width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: var(--c-border); font-size: .7rem; font-weight: 700; }
    .step.done .step-num  { background: var(--c-success); color: #fff; }
    .step.done  { color: var(--c-success); }
    .step.active .step-num { background: var(--c-gold); color: #fff; }
    .step.active { color: var(--c-gold-dk); }
    .step-line { flex: 1; height: 2px; background: var(--c-border); margin: 0 .5rem; }

    /* Info boxes */
    .auth-info-box { border-radius: 8px; padding: .75rem 1rem; font-size: .8rem; margin: .75rem 0; }
    .auth-info-blue  { background: #eff6ff; border: 1px solid var(--c-primary-lt); color: #1e40af; }
    .auth-info-gold  { background: var(--c-gold-lt); border: 1px solid var(--c-gold); color: #92400e; }
    .auth-info-green { background: #f0fdf4; border: 2px dashed var(--c-success); }

    /* Alert flash */
    .auth-alert { border-radius: 8px; font-size: .86rem; padding: .75rem 1rem; margin-bottom: 1rem; }
    .auth-alert-danger  { background: #fef2f2; color: #991b1b; border-left: 4px solid var(--c-danger); }
    .auth-alert-success { background: #ecfdf5; color: #065f46; border-left: 4px solid var(--c-success); }

    /* Checkbox */
    .auth-check { display: flex; align-items: center; gap: .5rem; font-size: .85rem; margin: .5rem 0; }
    .auth-check input { accent-color: var(--c-primary); width: 16px; height: 16px; }

    /* PW strength */
    .pw-strength-bar   { height: 4px; border-radius: 4px; background: var(--c-border); transition: all .3s; width: 0; }
    .pw-strength-label { font-size: .73rem; color: var(--c-text-muted); }

    /* 2-col grid */
    .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 480px) { .form-row-2 { grid-template-columns: 1fr; } }

    /* Copy button */
    .copy-btn {
        display: inline-flex; align-items: center; gap: .35rem;
        padding: .45rem 1.1rem; background: var(--c-success); color: #fff;
        border: none; border-radius: 8px; font-size: .82rem; font-weight: 600; cursor: pointer;
        transition: background .18s;
    }
    .copy-btn:hover { background: #059669; }
    .copy-btn.copied { background: #047857; }

    /* Theme toggle */
    .auth-theme-btn {
        position: fixed; top: 1rem; right: 1rem;
        width: 38px; height: 38px; border-radius: 50%;
        background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.25);
        cursor: pointer; font-size: 1rem; display: flex; align-items: center; justify-content: center;
        backdrop-filter: blur(8px); z-index: 100; transition: background .18s;
    }
    .auth-theme-btn:hover { background: rgba(255,255,255,.25); }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<button class="auth-theme-btn" id="themeToggleBtn" onclick="toggleTheme()" title="Toggle dark mode">🌙</button>

<?= $content ?>

<?php $this->endBody() ?>
<script>
(function(){
    const html = document.documentElement;
    const btn  = document.getElementById('themeToggleBtn');
    const saved = localStorage.getItem('church-theme') || 'light';
    function applyTheme(t) {
        html.setAttribute('data-bs-theme', t);
        if (btn) btn.textContent = t === 'dark' ? '☀️' : '🌙';
        localStorage.setItem('church-theme', t);
    }
    applyTheme(saved);
    window.toggleTheme = function() {
        applyTheme(html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark');
    };
})();
</script>
</body>
</html>
<?php $this->endPage() ?>