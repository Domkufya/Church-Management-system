<?php
use yii\helpers\Html;
$this->title = 'Prayer Requests';
?>

<div style="padding-top:70px;">

    <div style="background:linear-gradient(135deg, #6f42c1 0%, #4a2c82 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px;">
        <h2 style="margin:0;">🙏 Prayer Requests</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">"The prayer of a righteous person is powerful and effective." — James 5:16</p>
    </div>

    <!-- My Requests -->
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 3px 12px rgba(0,0,0,0.08); margin-bottom:25px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h5 style="color:#6f42c1; margin:0;">🙏 My Prayer Requests</h5>
            <?= Html::a('+ Submit New', ['/member/create-prayer'], ['style' => 'background:#6f42c1; color:white; padding:8px 18px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;']) ?>
        </div>

        <?php if (empty($myPrayers)): ?>
        <p style="color:#888; text-align:center; padding:20px;">No prayer requests yet.</p>
        <?php else: ?>
        <table class="table" style="font-size:14px;">
            <thead style="background:#f3e8ff;">
                <tr><th>#</th><th>Request</th><th>Status</th><th>Date</th></tr>
            </thead>
            <tbody>
            <?php foreach ($myPrayers as $i => $prayer): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= Html::encode(mb_substr($prayer->request, 0, 80)) ?>...</td>
                    <td>
                        <?php
                        $colors = ['Pending' => '#f6c23e', 'Prayed' => '#1cc88a', 'Answered' => '#4e73df'];
                        $color = $colors[$prayer->status] ?? '#888';
                        ?>
                        <span style="background:<?= $color ?>; color:white; padding:3px 10px; border-radius:10px; font-size:11px;">
                            <?= Html::encode($prayer->status) ?>
                        </span>
                    </td>
                    <td><?= date('d M Y', strtotime($prayer->created_at)) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>

    <!-- Church Prayers -->
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
        <h5 style="color:#4a2c82; margin:0 0 15px 0;">⛪ Church Prayer Requests</h5>

        <?php if (empty($adminPrayers)): ?>
        <p style="color:#888; text-align:center; padding:20px;">No church prayer requests yet.</p>
        <?php else: ?>
        <div class="row">
            <?php foreach ($adminPrayers as $prayer): ?>
            <div class="col-md-6" style="margin-bottom:15px;">
                <div style="background:#f9f0ff; border-radius:10px; padding:15px; border-left:4px solid #6f42c1;">
                    <p style="color:#444; font-size:14px; margin:0 0 8px 0;">🙏 <?= Html::encode($prayer->request) ?></p>
                    <span style="color:#888; font-size:12px;">📅 <?= date('d M Y', strtotime($prayer->created_at)) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

</div>