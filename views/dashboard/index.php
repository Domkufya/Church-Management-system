<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
$this->title = 'Dashboard';
?>

<div style="padding-top: 70px;">

    <!-- Welcome Bar -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 25px;">
        <h2 style="margin:0;">⛪ Faith Christian Church</h2>
        <p style="margin:5px 0 0 0; opacity:0.85;">Welcome back, <?= Html::encode(Yii::$app->user->identity->username) ?>! — <?= date('l, d F Y') ?></p>
    </div>

    <?php if ($pending_requests > 0): ?>
<div style="background:#fff3cd; border:1px solid #ffc107; border-radius:10px; padding:15px 20px; margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
    <span style="color:#856404; font-weight:600;">⚠️ You have <strong><?= $pending_requests ?></strong> pending department join request(s)!</span>
    <?= \yii\helpers\Html::a('Review Requests →', ['/departments/requests'], [
        'style' => 'background:#ffc107; color:#333; padding:8px 18px; border-radius:8px; text-decoration:none; font-weight:700; font-size:13px;'
    ]) ?>
</div>
<?php endif; ?>



    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #4e73df;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:#4e73df; font-size:12px; font-weight:700; text-transform:uppercase; margin:0;">Total Members</p>
                        <h3 style="font-size:28px; font-weight:700; margin:5px 0 0 0;"><?= $stats['members'] ?></h3>
                    </div>
                    <span style="font-size:35px;">👥</span>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/members/index']) ?>" style="font-size:12px; color:#4e73df;">View All →</a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #1cc88a;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:#1cc88a; font-size:12px; font-weight:700; text-transform:uppercase; margin:0;">Total Offerings</p>
                        <h3 style="font-size:22px; font-weight:700; margin:5px 0 0 0;">TZS <?= number_format($stats['offerings'], 0) ?></h3>
                    </div>
                    <span style="font-size:35px;">💰</span>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/offerings/index']) ?>" style="font-size:12px; color:#1cc88a;">View All →</a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #e74a3b;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:#e74a3b; font-size:12px; font-weight:700; text-transform:uppercase; margin:0;">Total Expenses</p>
                        <h3 style="font-size:22px; font-weight:700; margin:5px 0 0 0;">TZS <?= number_format($stats['expenses'], 0) ?></h3>
                    </div>
                    <span style="font-size:35px;">💸</span>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/expenses/index']) ?>" style="font-size:12px; color:#e74a3b;">View All →</a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #f6c23e;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:#f6c23e; font-size:12px; font-weight:700; text-transform:uppercase; margin:0;">Events</p>
                        <h3 style="font-size:28px; font-weight:700; margin:5px 0 0 0;"><?= $stats['events'] ?></h3>
                    </div>
                    <span style="font-size:35px;">📅</span>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/events/index']) ?>" style="font-size:12px; color:#f6c23e;">View All →</a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #36b9cc;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:#36b9cc; font-size:12px; font-weight:700; text-transform:uppercase; margin:0;">Departments</p>
                        <h3 style="font-size:28px; font-weight:700; margin:5px 0 0 0;"><?= $stats['departments'] ?></h3>
                    </div>
                    <span style="font-size:35px;">🏛️</span>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/departments/index']) ?>" style="font-size:12px; color:#36b9cc;">View All →</a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #6f42c1;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:#6f42c1; font-size:12px; font-weight:700; text-transform:uppercase; margin:0;">Prayer Requests</p>
                        <h3 style="font-size:28px; font-weight:700; margin:5px 0 0 0;"><?= $stats['prayer_requests'] ?></h3>
                    </div>
                    <span style="font-size:35px;">🙏</span>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/prayer-requests/index']) ?>" style="font-size:12px; color:#6f42c1;">View All →</a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #fd7e14;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:#fd7e14; font-size:12px; font-weight:700; text-transform:uppercase; margin:0;">Children</p>
                        <h3 style="font-size:28px; font-weight:700; margin:5px 0 0 0;"><?= $stats['children'] ?></h3>
                    </div>
                    <span style="font-size:35px;">👶</span>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/children/index']) ?>" style="font-size:12px; color:#fd7e14;">View All →</a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08); border-left: 4px solid #20c997;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:#20c997; font-size:12px; font-weight:700; text-transform:uppercase; margin:0;">Attendance</p>
                        <h3 style="font-size:28px; font-weight:700; margin:5px 0 0 0;"><?= $stats['attendance'] ?></h3>
                    </div>
                    <span style="font-size:35px;">📊</span>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/attendance/index']) ?>" style="font-size:12px; color:#20c997;">View All →</a>
            </div>
        </div>
    </div>

    <!-- Recent Tables -->
    <div class="row">
        <div class="col-md-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08);">
                <h5 style="border-bottom:2px solid #4e73df; padding-bottom:10px; color:#4e73df;">👥 Recent Members</h5>
                <table class="table table-hover" style="font-size:14px;">
                    <thead><tr><th>#</th><th>Name</th><th>Phone</th></tr></thead>
                    <tbody>
                        <?php foreach ($recent_members as $i => $member): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= Html::encode($member->first_name . ' ' . $member->last_name) ?></td>
                            <td><?= Html::encode($member->phone) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($recent_members)): ?>
                        <tr><td colspan="3" class="text-center text-muted">No members yet</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6" style="margin-bottom: 20px;">
            <div style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.08);">
                <h5 style="border-bottom:2px solid #f6c23e; padding-bottom:10px; color:#f6c23e;">📅 Recent Events</h5>
                <table class="table table-hover" style="font-size:14px;">
                    <thead><tr><th>#</th><th>Event</th><th>Date</th></tr></thead>
                    <tbody>
                        <?php foreach ($recent_events as $i => $event): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= Html::encode($event->title) ?></td>
                            <td><?= Html::encode($event->event_date) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($recent_events)): ?>
                        <tr><td colspan="3" class="text-center text-muted">No events yet</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>