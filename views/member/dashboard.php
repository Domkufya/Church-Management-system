<?php
use yii\helpers\Html;
$this->title = 'Member Dashboard';
?>
<div style="padding-top: 70px;">

    <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; padding: 25px 30px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(17,153,142,0.3);">
        <h2 style="margin:0; font-size:24px;">⛪ Faith Christian Church</h2>
        <p style="margin:8px 0 0 0; opacity:0.9; font-size:15px;">Welcome, <?= Html::encode($user->username) ?>! — <?= date('l, d F Y') ?></p>
        <p style="margin:5px 0 0 0; opacity:0.8; font-size:13px;">🙏 "For where two or three gather in my name, there am I with them." — Matthew 18:20</p>
    </div>

    <h5 style="color:#555; margin-bottom:15px; font-weight:600;">📌 Quick Access</h5>
    <div class="row">

        <div class="col-xs-6 col-md-3" style="margin-bottom:20px;">
            <div style="background:#fff; border-radius:12px; padding:25px 20px; box-shadow:0 3px 12px rgba(0,0,0,0.08); border-top:4px solid #4e73df; text-align:center;">
                <div style="font-size:40px; margin-bottom:10px;">📢</div>
                <h5 style="color:#4e73df; font-weight:700; margin:0 0 8px 0;">Announcements</h5>
                <p style="color:#888; font-size:13px; margin:0 0 15px 0;">View church announcements & events</p>
                <?= Html::a('View →', ['/events/index'], ['style' => 'background:#4e73df; color:white; padding:8px 20px; border-radius:20px; text-decoration:none; font-size:13px; font-weight:600;']) ?>
            </div>
        </div>

        <div class="col-xs-6 col-md-3" style="margin-bottom:20px;">
            <div style="background:#fff; border-radius:12px; padding:25px 20px; box-shadow:0 3px 12px rgba(0,0,0,0.08); border-top:4px solid #7b2ff7; text-align:center;">
                <div style="font-size:40px; margin-bottom:10px;">🙏</div>
                <h5 style="color:#7b2ff7; font-weight:700; margin:0 0 8px 0;">Prayer Requests</h5>
                <p style="color:#888; font-size:13px; margin:0 0 15px 0;">Submit & view your prayer requests</p>
                <?= Html::a('View →', ['/member/prayers'], ['style' => 'background:#7b2ff7; color:white; padding:8px 20px; border-radius:20px; text-decoration:none; font-size:13px; font-weight:600;']) ?>
            </div>
        </div>

        <div class="col-xs-6 col-md-3" style="margin-bottom:20px;">
            <div style="background:#fff; border-radius:12px; padding:25px 20px; box-shadow:0 3px 12px rgba(0,0,0,0.08); border-top:4px solid #f6c23e; text-align:center;">
                <div style="font-size:40px; margin-bottom:10px;">💰</div>
                <h5 style="color:#f6c23e; font-weight:700; margin:0 0 8px 0;">Offerings</h5>
                <p style="color:#888; font-size:13px; margin:0 0 15px 0;">View your offering records</p>
                <?= Html::a('View →', ['/member/offerings'], ['style' => 'background:#f6c23e; color:white; padding:8px 20px; border-radius:20px; text-decoration:none; font-size:13px; font-weight:600;']) ?>
            </div>
        </div>

        <div class="col-xs-6 col-md-3" style="margin-bottom:20px;">
            <div style="background:#fff; border-radius:12px; padding:25px 20px; box-shadow:0 3px 12px rgba(0,0,0,0.08); border-top:4px solid #e74c3c; text-align:center;">
                <div style="font-size:40px; margin-bottom:10px;">👤</div>
                <h5 style="color:#e74c3c; font-weight:700; margin:0 0 8px 0;">My Profile</h5>
                <p style="color:#888; font-size:13px; margin:0 0 15px 0;">View & update your profile</p>
                <?= Html::a('View →', ['/member/profile'], ['style' => 'background:#e74c3c; color:white; padding:8px 20px; border-radius:20px; text-decoration:none; font-size:13px; font-weight:600;']) ?>
            </div>
        </div>

    </div>

    <h5 style="color:#555; margin-top:10px; margin-bottom:15px; font-weight:600;">🙏 Recent Prayer Requests</h5>
    <div style="background:#fff; border-radius:12px; padding:20px; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
        <?php if (empty($prayers)): ?>
            <p style="color:#888; text-align:center;">No prayer requests yet.</p>
            <?= Html::a('+ Submit Your First Prayer Request', ['/member/create-prayer'], ['style' => 'display:block; text-align:center; background: linear-gradient(135deg, #4f8ef7, #7b2ff7); color:white; padding:12px; border-radius:10px; text-decoration:none; font-weight:600; margin-top:10px;']) ?>
        <?php else: ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Request</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prayers as $i => $prayer): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= Html::encode(substr($prayer->request, 0, 60)) ?>...</td>
                        <td>
                            <?php
                            $colors = ['Pending' => '#e67e22', 'Prayed' => '#2980b9', 'Answered' => '#27ae60'];
                            $color = $colors[$prayer->status] ?? '#888';
                            ?>
                            <span style="background:<?= $color ?>; color:#fff; padding:3px 10px; border-radius:20px; font-size:12px;"><?= $prayer->status ?></span>
                        </td>
                        <td><?= Html::encode($prayer->created_at) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= Html::a('+ Submit New Prayer Request', ['/member/create-prayer'], ['style' => 'display:block; text-align:center; background: linear-gradient(135deg, #4f8ef7, #7b2ff7); color:white; padding:12px; border-radius:10px; text-decoration:none; font-weight:600; margin-top:10px;']) ?>
        <?php endif; ?>
    </div>
</div>