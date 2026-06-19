<?php
/**
 * Superadmin Users Management view
 * Place at: views/superadmin/users.php
 *
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\Roles[] $roles
 * @var string $roleFilter
 */
declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\User;

$this->title = 'Manage Users';
?>

<style>
.sa-section { background:var(--c-surface); border:1px solid var(--c-border); border-radius:14px; padding:1.5rem; margin-bottom:1.5rem; }
.sa-table { width:100%; border-collapse:collapse; font-size:.85rem; }
.sa-table th { background:var(--c-bg); font-weight:700; font-size:.75rem; text-transform:uppercase; letter-spacing:.07em; color:var(--c-text-muted); padding:.6rem 1rem; text-align:left; border-bottom:2px solid var(--c-border); }
.sa-table td { padding:.7rem 1rem; border-bottom:1px solid var(--c-border); vertical-align:middle; }
.sa-table tr:last-child td { border-bottom:none; }
.sa-table tr:hover td { background:var(--c-bg); }
.role-badge { display:inline-block; padding:.2rem .65rem; border-radius:20px; font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em; }
.role-superadmin { background:#fef3c7; color:#92400e; }
.role-admin { background:#dbeafe; color:#1e40af; }
.role-pastor { background:#ede9fe; color:#5b21b6; }
.role-secretary { background:#dcfce7; color:#065f46; }
.role-treasurer { background:#fce7f3; color:#9d174d; }
.role-department_leader { background:#e0f2fe; color:#0369a1; }
.role-member { background:#f3f4f6; color:#374151; }
.status-badge { display:inline-block; padding:.2rem .6rem; border-radius:20px; font-size:.72rem; font-weight:700; }
.status-active { background:#dcfce7; color:#065f46; }
.status-inactive { background:#fef2f2; color:#991b1b; }
.btn-sa { display:inline-flex; align-items:center; gap:.3rem; padding:.3rem .75rem; border-radius:7px; font-size:.76rem; font-weight:600; border:none; cursor:pointer; transition:background .18s; text-decoration:none; }
.btn-sa-primary { background:var(--c-primary); color:#fff; }
.btn-sa-primary:hover { background:var(--c-primary-dk); color:#fff; }
.btn-sa-gold { background:var(--c-gold); color:#fff; }
.btn-sa-gold:hover { background:var(--c-gold-dk); color:#fff; }
.btn-sa-danger { background:#ef4444; color:#fff; }
.btn-sa-danger:hover { background:#dc2626; color:#fff; }
.btn-sa-gray { background:#6b7280; color:#fff; }
.btn-sa-gray:hover { background:#4b5563; color:#fff; }
.filter-tabs { display:flex; gap:.5rem; flex-wrap:wrap; margin-bottom:1.5rem; }
.filter-tab { padding:.4rem 1rem; border-radius:20px; font-size:.78rem; font-weight:600; border:1.5px solid var(--c-border); color:var(--c-text-muted); cursor:pointer; transition:all .18s; text-decoration:none; }
.filter-tab:hover, .filter-tab.active { background:var(--c-primary); color:#fff; border-color:var(--c-primary); }
.role-select { padding:.35rem .7rem; border-radius:8px; border:1.5px solid var(--c-border); font-size:.82rem; color:var(--c-text); background:#fff; cursor:pointer; }
</style>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <div>
        <h2 style="margin:0;font-size:1.5rem;color:var(--c-primary);">👥 Manage Users</h2>
        <p style="margin:.25rem 0 0;color:var(--c-text-muted);font-size:.85rem;">
            Assign roles and manage all system accounts
        </p>
    </div>
    <a href="<?= Url::to(['/superadmin/dashboard']) ?>" class="btn-sa btn-sa-gray">← Dashboard</a>
</div>

<!-- Flash messages -->
<?php foreach (Yii::$app->session->getAllFlashes() as $type => $msg): ?>
    <div style="padding:.75rem 1rem;border-radius:8px;margin-bottom:1rem;
        background:<?= $type === 'error' ? '#fef2f2' : '#ecfdf5' ?>;
        border-left:4px solid <?= $type === 'error' ? '#ef4444' : '#10b981' ?>;
        color:<?= $type === 'error' ? '#991b1b' : '#065f46' ?>;font-size:.86rem;">
        <?= Html::encode(is_array($msg) ? implode(' ', $msg) : $msg) ?>
    </div>
<?php endforeach; ?>

<!-- Role filter tabs -->
<div class="filter-tabs">
    <a href="<?= Url::to(['/superadmin/users']) ?>"
       class="filter-tab <?= $roleFilter === '' ? 'active' : '' ?>">All Users</a>
    <?php foreach ($roles as $role): ?>
        <a href="<?= Url::to(['/superadmin/users', 'role' => $role->name]) ?>"
           class="filter-tab <?= $roleFilter === $role->name ? 'active' : '' ?>">
            <?= Html::encode($role->label) ?>
        </a>
    <?php endforeach; ?>
</div>

<div class="sa-section" style="padding:0;overflow:hidden;">
    <table class="sa-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Current Role</th>
                <th>Status</th>
                <th style="min-width:220px;">Assign Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvider->getModels() as $u): ?>
            <tr>
                <td style="color:var(--c-text-muted);"><?= $u->id ?></td>
                <td>
                    <strong><?= Html::encode($u->username) ?></strong>
                    <?php if ($u->id === Yii::$app->user->id): ?>
                        <span style="font-size:.7rem;background:#fef3c7;color:#92400e;padding:.1rem .4rem;border-radius:4px;margin-left:.3rem;">You</span>
                    <?php endif; ?>
                </td>
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
                    <?php if ($u->id !== Yii::$app->user->id): ?>
                        <div style="display:flex;gap:.4rem;align-items:center;">
                            <select class="role-select" id="role-<?= $u->id ?>">
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= Html::encode($role->name) ?>"
                                        <?= $u->role === $role->name ? 'selected' : '' ?>>
                                        <?= Html::encode($role->label) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <a href="#"
                               onclick="assignRole(<?= $u->id ?>); return false;"
                               class="btn-sa btn-sa-primary">Assign</a>
                        </div>
                    <?php else: ?>
                        <span style="font-size:.78rem;color:var(--c-text-muted);">Cannot change own role</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="display:flex;gap:.3rem;flex-wrap:wrap;">
                        <?php if ($u->id !== Yii::$app->user->id): ?>

                            <a href="<?= Url::to(['/superadmin/toggle-status', 'id' => $u->id]) ?>"
                               class="btn-sa <?= $u->status ? 'btn-sa-gray' : 'btn-sa-gold' ?>">
                                <?= $u->status ? '🔒 Deactivate' : '✅ Activate' ?>
                            </a>

                            <?php if ($u->role !== User::ROLE_SUPERADMIN): ?>
                                <a href="<?= Url::to(['/superadmin/delete-user', 'user_id' => $u->id]) ?>"
                                   class="btn-sa btn-sa-danger"
                                   onclick="return confirm('Delete <?= Html::encode(addslashes($u->username)) ?>? This cannot be undone.')">
                                    🗑 Delete
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>

<script>
function assignRole(userId) {
    const role = document.getElementById('role-' + userId).value;
    window.location.href = '<?= Url::base(true) ?>/superadmin/assign-role?user_id=' + userId + '&role=' + role;
}
</script>