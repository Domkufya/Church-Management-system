<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

$this->render('_head');

$isGuest = Yii::$app->user->isGuest;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-bs-theme="light">
<head>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title ?? Yii::$app->name) ?></title>
</head>
<body>
<?php $this->beginBody() ?>

<?php if ($isGuest): ?>
<!-- ═══════════════════════════════════════════════════════════════
     GUEST LANDING PAGE — Two-panel immersive layout
═══════════════════════════════════════════════════════════════ -->
<div class="landing-wrap">

    <!-- Left: Brand Panel -->
    <div class="landing-panel-left">
        <div class="landing-logo-badge">✝ Faith Christian Church</div>

        <h1 class="landing-title">
            Your Church,<br>
            <span>One Platform.</span>
        </h1>

        <p class="landing-sub">
            Manage members, track attendance, handle offerings, and
            keep your congregation connected — all in one place.
        </p>

        <blockquote class="landing-verse">
            <p>"For where two or three gather in my name,<br>
               there am I with them."</p>
            <cite>— Matthew 18:20</cite>
        </blockquote>

        <div class="landing-stats">
            <div class="landing-stat-item">
                <span class="num">∞</span>
                <span class="lbl">Members</span>
            </div>
            <div class="landing-stat-item">
                <span class="num">24/7</span>
                <span class="lbl">Access</span>
            </div>
            <div class="landing-stat-item">
                <span class="num">100%</span>
                <span class="lbl">Secure</span>
            </div>
        </div>
    </div>

    <!-- Right: Action Panel -->
    <div class="landing-panel-right">
        <div class="welcome-text">
            <h2>Welcome</h2>
            <p>Access your church dashboard or join the community</p>
        </div>

        <div class="landing-action-card">

            <!-- Sign In Button -->
            <a href="<?= Url::to(['/site/login']) ?>" class="btn-primary-church">
                🔑 Sign In
            </a>

            <div class="divider">or</div>

            <!-- Create Account Button -->
            <a href="<?= Url::to(['/site/register']) ?>" class="btn-gold-church">
                ✨ Create Account
            </a>

            <!-- Forgot Password link -->
            <div style="text-align:center; margin-top:1rem;">
                <a href="<?= Url::to(['/site/forgot-password']) ?>"
                   style="font-size:0.82rem; color:var(--c-text-muted); text-decoration:underline;">
                    Forgot your password?
                </a>
            </div>

        </div>

        <!-- Contact link -->
        <div style="text-align:center; margin-bottom:1.2rem;">
            <a href="<?= Url::to(['/site/contact']) ?>"
               style="font-size:0.82rem; color:var(--c-primary-md);">
                ✉️ Contact the Church
            </a>
        </div>

        <div class="landing-features">
            <div class="landing-feature-pill">
                <span class="pill-icon">👥</span> Members
            </div>
            <div class="landing-feature-pill">
                <span class="pill-icon">📅</span> Events
            </div>
            <div class="landing-feature-pill">
                <span class="pill-icon">💰</span> Finance
            </div>
            <div class="landing-feature-pill">
                <span class="pill-icon">🙏</span> Prayer
            </div>
            <div class="landing-feature-pill">
                <span class="pill-icon">✅</span> Attendance
            </div>
            <div class="landing-feature-pill">
                <span class="pill-icon">👶</span> Children
            </div>
        </div>

        <div class="landing-footer-note">
            &copy; <?= date('Y') ?> <?= Html::encode(Yii::$app->name) ?> &mdash; All rights reserved.
        </div>
    </div>

</div><!-- /.landing-wrap -->

<?php else: ?>
<!-- ═══════════════════════════════════════════════════════════════
     AUTHENTICATED APP SHELL — Sidebar layout
═══════════════════════════════════════════════════════════════ -->
<div class="app-shell" id="appShell">

    <?= $this->render('_header') ?>

    <!-- Content wrapper -->
    <div class="app-content-wrap">

        <main class="app-content" role="main">

            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>

            <?= Alert::widget() ?>

            <?= $content ?>

        </main>

        <?= $this->render('_footer') ?>

    </div><!-- /.app-content-wrap -->

</div><!-- /.app-shell -->

<?php endif; ?>

<?php $this->endBody() ?>

<!-- ═══════════════════════════════════════════════════
     SCRIPTS
═══════════════════════════════════════════════════ -->
<script>
(function () {
    'use strict';

    /* ── Theme ───────────────────────────────────────── */
    const html     = document.documentElement;
    const themeBtn = document.getElementById('themeToggleBtn');
    const saved    = localStorage.getItem('church-theme') || 'light';

    function applyTheme(t) {
        html.setAttribute('data-bs-theme', t);
        if (themeBtn) themeBtn.textContent = t === 'dark' ? '☀️' : '🌙';
        localStorage.setItem('church-theme', t);
    }

    applyTheme(saved);

    window.toggleTheme = function () {
        applyTheme(html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark');
    };

    /* ── Sidebar collapse (desktop) ──────────────────── */
    const shell   = document.getElementById('appShell');
    const sidebar = document.getElementById('appSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const isMobile = () => window.innerWidth <= 992;

    const sidebarState = localStorage.getItem('sidebar-collapsed') === '1';
    if (sidebarState && !isMobile()) {
        sidebar  && sidebar.classList.add('collapsed');
        shell    && shell.classList.add('sidebar-collapsed');
    }

    window.toggleSidebar = function () {
        if (isMobile()) {
            sidebar  && sidebar.classList.toggle('mobile-open');
            overlay  && overlay.classList.toggle('visible');
        } else {
            sidebar  && sidebar.classList.toggle('collapsed');
            shell    && shell.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed') ? '1' : '0');
        }
    };

    window.closeMobileSidebar = function () {
        sidebar && sidebar.classList.remove('mobile-open');
        overlay && overlay.classList.remove('visible');
    };

    /* ── Finance dropdown ────────────────────────────── */
    window.toggleSidebarDropdown = function (btn) {
        const body = btn.nextElementSibling;
        if (!body) return;
        btn.classList.toggle('open');
        body.classList.toggle('open');
    };

    /* ── Sync topbar title with page title ───────────── */
    const titleEl = document.getElementById('topbarTitle');
    if (titleEl && document.title) {
        titleEl.textContent = document.title.replace(' | ' + <?= json_encode(Yii::$app->name) ?>, '');
    }

})();
</script>

</body>
</html>
<?php $this->endPage() ?>