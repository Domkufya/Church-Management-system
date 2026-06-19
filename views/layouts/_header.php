<?php
/**
 * App header / sidebar
 * Place at: views/layouts/_header.php
 */
declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;

if (Yii::$app->user->isGuest) { return; }

$user     = Yii::$app->user->identity;
$role     = $user->role     ?? 'member';
$username = $user->username ?? 'User';
$initial  = strtoupper(mb_substr($username, 0, 1));
$ctrl     = Yii::$app->controller->id;

function sidebarLink(string $label, string $icon, array $url, string $ctrl, string $targetCtrl): string {
    $active = ($ctrl === $targetCtrl) ? ' active' : '';
    $href   = Url::to($url);
    return <<<HTML
    <a href="{$href}" class="sidebar-nav-item{$active}" data-label="{$label}">
        <span class="nav-icon">{$icon}</span>
        <span class="nav-label">{$label}</span>
    </a>
    HTML;
}
?>

<aside class="app-sidebar" id="appSidebar">

    <a href="<?= Url::home() ?>" class="sidebar-brand">
        <div class="sidebar-brand-icon">✝</div>
        <div class="sidebar-brand-text">
            <strong><?= Html::encode(Yii::$app->name) ?></strong>
            <span>Management System</span>
        </div>
    </a>

    <div class="sidebar-scroll">

        <?php if ($role === User::ROLE_SUPERADMIN): ?>
        <!-- ══ SUPERADMIN NAV ══ -->
        <div class="sidebar-section-label">⚡ Super Admin</div>
        <?= sidebarLink('Dashboard',    '📊', ['/superadmin/dashboard'], $ctrl, 'superadmin') ?>
        <?= sidebarLink('Manage Users', '👥', ['/superadmin/users'],     $ctrl, 'superadmin') ?>

        <div class="sidebar-section-label">System</div>
        <?= sidebarLink('Members',    '👤', ['/members/index'],    $ctrl, 'members') ?>
        <?= sidebarLink('Events',     '📅', ['/events/index'],     $ctrl, 'events') ?>
        <?= sidebarLink('Attendance', '✅', ['/attendance/index'], $ctrl, 'attendance') ?>
        <?= sidebarLink('Finance',    '💰', ['/offerings/index'],  $ctrl, 'offerings') ?>

        <?php elseif ($role === User::ROLE_MEMBER): ?>
        <!-- ══ MEMBER NAV ══ -->
        <div class="sidebar-section-label">Navigation</div>
        <?= sidebarLink('Dashboard',       '🏠', ['/member/dashboard'],      $ctrl, 'member') ?>
        <?= sidebarLink('Announcements',   '📢', ['/events/index'],           $ctrl, 'events') ?>
        <?= sidebarLink('Prayer Requests', '🙏', ['/prayer-requests/index'],  $ctrl, 'prayer-requests') ?>
        <?= sidebarLink('Offerings',       '💛', ['/site/offerings'],          $ctrl, 'offerings') ?>
        <?= sidebarLink('Departments',     '🏛️', ['/departments/index'],      $ctrl, 'departments') ?>
        <div class="sidebar-section-label">Account</div>
        <?= sidebarLink('My Profile', '👤', ['/site/profile'], $ctrl, 'site') ?>

        <?php else: ?>
        <!-- ══ ADMIN / PASTOR / SECRETARY / TREASURER / DEPT LEADER NAV ══ -->
        <div class="sidebar-section-label">Main</div>
        <?= sidebarLink('Dashboard', '📊', ['/dashboard/index'], $ctrl, 'dashboard') ?>
        <?= sidebarLink('Members',   '👥', ['/members/index'],   $ctrl, 'members') ?>

        <div class="sidebar-section-label">Ministry</div>
        <?= sidebarLink('Events',          '📅', ['/events/index'],          $ctrl, 'events') ?>
        <?= sidebarLink('Departments',     '🏛️', ['/departments/index'],     $ctrl, 'departments') ?>
        <?= sidebarLink('Attendance',      '✅', ['/attendance/index'],      $ctrl, 'attendance') ?>
        <?= sidebarLink('Children',        '👶', ['/children/index'],        $ctrl, 'children') ?>
        <?= sidebarLink('Prayer Requests', '🙏', ['/prayer-requests/index'], $ctrl, 'prayer-requests') ?>

        <div class="sidebar-section-label">Finance</div>
        <button type="button"
                class="sidebar-nav-item<?= in_array($ctrl, ['offerings','expenses']) ? ' active open' : '' ?>"
                onclick="toggleSidebarDropdown(this)" data-label="Finance">
            <span class="nav-icon">💰</span>
            <span class="nav-label">Finance</span>
            <span class="nav-chevron">▶</span>
        </button>
        <div class="sidebar-dropdown-body<?= in_array($ctrl, ['offerings','expenses']) ? ' open' : '' ?>">
            <a href="<?= Url::to(['/offerings/index']) ?>"
               class="sidebar-sub-item<?= $ctrl === 'offerings' ? ' active' : '' ?>">💵 Offerings</a>
            <a href="<?= Url::to(['/expenses/index']) ?>"
               class="sidebar-sub-item<?= $ctrl === 'expenses'  ? ' active' : '' ?>">📉 Expenses</a>
        </div>

        <?php if (in_array($role, [User::ROLE_ADMIN], true)): ?>
        <div class="sidebar-section-label">Admin</div>
        <?= sidebarLink('Users', '🔐', ['/users/index'], $ctrl, 'users') ?>
        <?php endif; ?>

        <?php endif; ?>

    </div>

    <!-- Role badge + user footer -->
    <div class="sidebar-footer">
        <div class="sidebar-user-avatar"><?= Html::encode($initial) ?></div>
        <div class="sidebar-user-info">
            <div class="uname"><?= Html::encode($username) ?></div>
            <div class="urole" style="font-size:.7rem;opacity:.8;">
                <?= Html::encode($user->getRoleLabel()) ?>
            </div>
        </div>
        <?= Html::a('⏻', ['/site/logout'], [
            'class'       => 'sidebar-logout-btn',
            'title'       => 'Logout',
            'data-method' => 'post',
        ]) ?>
    </div>

</aside>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobileSidebar()"></div>

<div class="app-topbar" id="appTopbar">
    <button class="topbar-toggle" id="sidebarToggleBtn" onclick="toggleSidebar()">☰</button>
    <div class="topbar-page-title" id="topbarTitle">
        <?= Html::encode($this->title ?? Yii::$app->name) ?>
    </div>
    <div class="topbar-actions">
        <?php if ($role === User::ROLE_SUPERADMIN): ?>
        <span style="background:#fef3c7;color:#92400e;padding:.2rem .7rem;border-radius:20px;font-size:.72rem;font-weight:700;letter-spacing:.05em;margin-right:.5rem;">
            ⚡ SUPERADMIN
        </span>
        <?php endif; ?>
        <button class="topbar-icon-btn" id="themeToggleBtn" onclick="toggleTheme()" title="Toggle dark mode">🌙</button>
        <div class="topbar-icon-btn" title="<?= Html::encode($username) ?>"
             style="background:var(--c-primary);color:#fff;border-color:var(--c-primary);font-size:.8rem;font-weight:700;">
            <?= Html::encode($initial) ?>
        </div>
    </div>
</div>