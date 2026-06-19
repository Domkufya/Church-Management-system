<?php
/**
 * Superadmin Dashboard view
 * Place at: views/superadmin/dashboard.php
 *
 * @var yii\web\View $this
 * @var array $stats
 * @var app\models\User[] $recentUsers
 * @var app\models\Roles[] $roles
 */
declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Super Admin Dashboard';
?>

<style>
.sa-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:1rem; margin-bottom:2rem; }
.sa-stat-card {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: 14px;
    padding: 1.2rem 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,.05);
    transition: transform .18s, box-shadow .18s;
}
.sa-stat-card:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,.1); }
.sa-stat-num  { font-size:2rem; font-weight:800; color:var(--c-primary); line-height:1; margin-bottom:.25rem; }
.sa-stat-lbl  { font-size:.75rem; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:var(--c-text-muted); }
.sa-stat-card.gold  .sa-stat-num { color:var(--c-gold-dk); }
.sa-stat-card.green .sa-stat-num { color:#059669; }
.sa-stat-card.red   .sa-stat-num { color:#dc2626; }

.sa-section { background:var(--c-surface); border:1px solid var(--c-border); border-radius:14px; padding:1.5rem; margin-bottom:1.5rem; }
.sa-section h3 { font-size:1rem; font-weight:700; margin:0 0 1rem; color:var(--c-text); }

.sa-table { width:100%; border-collapse:collapse; font-size:.85rem; }
.sa-table th { background:var(--c-bg); font-weight:700; font-size:.75rem; text-transform:uppercase; letter-spacing:.07em; color:var(--c-text-muted); padding:.6rem 1rem; text-align:left; border-bottom:2px solid var(--c-border); }
.sa-table td { padding:.7rem 1rem; border-bottom:1px solid var(--c-border); vertical-align:middle; }
.sa-table tr:last-child td { border-bottom:none; }
.sa-table tr:hover td { background:var(--c-bg); }

.role-badge {
    display:inline-block; padding:.2rem .65rem; border-radius:20px;
    font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em;
}
.role-superadmin   { background:#fef3c7; color:#92400e; }
.role-admin        { background:#dbeafe; color:#1e40af; }
.role-pastor       { background:#ede9fe; color:#5b21b6; }
.role-secretary    { background:#dcfce7; color:#065f46; }
.role-treasurer    { background:#fce7f3; color:#9d174d; }
.role-department_leader { background:#e0f2fe; color:#0369a1; }
.role-member       { background:#f3f4f6; color:#374151; }

.status-badge { display:inline-block; padding:.2rem .6rem; border-radius:20px; font-size:.72rem; font-weight:700; }
.status-active   { background:#dcfce7; color:#065f46; }
.status-inactive { background:#fef2f2; color:#991b1b; }

.btn-sa {
    display:inline-flex; align-items:center; gap:.35rem;
    padding:.35rem .85rem; border-radius:8px; font-size:.78rem; font-weight:600;
    border:none; cursor:pointer; transition:background .18s;
    text-decoration:none;
}
.btn-sa-primary { background:var(--c-primary); color:#fff; }
.btn-sa-primary:hover { background:var(--c-primary-dk); color:#fff; }
.btn-sa-gold { background:var(--c-gold); color:#fff; }
.btn-sa-gold:hover { background:var(--c-gold-dk); color:#fff; }
.btn-sa-danger { background:#ef4444; color:#fff; }
.btn-sa-danger:hover { background:#dc2626; color:#fff; }
</style>

<!-- Page header -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <div>
        <h2 style="margin:0;font-size:1.5rem;color:var(--c-primary);">⚡ Super Admin Dashboard</h2>
        <p style="margin:.25rem 0 0;color:var(--c-text-muted);font-size:.85rem;">
            Full system control — <?= date('l, F j, Y') ?>
        </p>
    </div>
    <a href="<?= Url::to(['/superadmin/users']) ?>" class="btn-sa btn-sa-primary">
        👥 Manage All Users
    </a>
</div>

<!-- Stats grid -->
<div class="sa-grid">
    <div class="sa-stat-card gold">
        <div class="sa-stat-num"><?= $stats['total_users'] ?></div>
        <div class="sa-stat-lbl">Total Users</div>
    </div>
    <div class="sa-stat-card" style="border-top:3px solid #92400e;">
        <div class="sa-stat-num" style="color:#92400e;"><?= $stats['superadmins'] ?></div>
        <div class="sa-stat-lbl">Super Admins</div>
    </div>
    <div class="sa-stat-card" style="border-top:3px solid var(--c-primary);">
        <div class="sa-stat-num"><?= $stats['admins'] ?></div>
        <div class="sa-stat-lbl">Admins</div>
    </div>
    <div class="sa-stat-card" style="border-top:3px solid #5b21b6;">
        <div class="sa-stat-num" style="color:#5b21b6;"><?= $stats['pastors'] ?></div>
        <div class="sa-stat-lbl">Pastors</div>
    </div>
    <div class="sa-stat-card" style="border-top:3px solid #059669;">
        <div class="sa-stat-num" style="color:#059669;"><?= $stats['secretaries'] ?></div>
        <div class="sa-stat-lbl">Secretaries</div>
    </div>
    <div class="sa-stat-card" style="border-top:3px solid #9d174d;">
        <div class="sa-stat-num" style="color:#9d174d;"><?= $stats['treasurers'] ?></div>
        <div class="sa-stat-lbl">Treasurers</div>
    </div>
    <div class="sa-stat-card" style="border-top:3px solid #0369a1;">
        <div class="sa-stat-num" style="color:#0369a1;"><?= $stats['dept_leaders'] ?></div>
        <div class="sa-stat-lbl">Dept Leaders</div>
    </div>
    <div class="sa-stat-card">
        <div class="sa-stat-num" style="color:#374151;"><?= $stats['members'] ?></div>
        <div class="sa-stat-lbl">Members</div>
    </div>
</div>

<!-- Recent users -->
<div class="sa-section">
    <h3>🕐 Recently Registered Users</h3>
    <table class="sa-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($recentUsers as $u): ?>
            <tr>
                <td><?= $u->id ?></td>
                <td><strong><?= Html::encode($u->username) ?></strong></td>
                <td><?= Html::encode($u->email) ?></td>
                <td>
                    <span class="role-badge role-<?= Html::encode($u->role) ?>">
                        <?= Html::encode($u->getRoleLabel()) ?>
                    </span>
                </td>
                <td>
                    <span class="status-badge status-<?= $u->status ? 'active' : 'inactive' ?>">
                        <?= $u->status ? 'Active' : 'Inactive' ?>
                    </span>
                </td>
                <td>
                    <a href="<?= Url::to(['/superadmin/users', 'role' => '']) ?>" class="btn-sa btn-sa-primary">
                        Manage
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div style="margin-top:1rem;text-align:right;">
        <a href="<?= Url::to(['/superadmin/users']) ?>" class="btn-sa btn-sa-gold">View All Users →</a>
    </div>
</div>