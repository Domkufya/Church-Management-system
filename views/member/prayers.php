<?php
use yii\helpers\Html;
$this->title = 'Prayer Requests';
?>
<div class="member-prayers" style="padding: 20px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2>🙏 Prayer Requests</h2>
        <?= Html::a('+ Submit New Request', ['/member/create-prayer'], [
            'style' => 'background: linear-gradient(135deg, #4f8ef7, #7b2ff7); color:white; padding:10px 20px; border-radius:20px; text-decoration:none; font-weight:600;'
        ]) ?>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Request</th>
                <th>Anonymous</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prayers as $i => $prayer): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= Html::encode(substr($prayer->request, 0, 80)) ?>...</td>
                <td><?= $prayer->is_anonymous ? '🙈 Yes' : '👁 No' ?></td>
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
            <?php if (empty($prayers)): ?>
            <tr>
                <td colspan="5" class="text-center" style="padding:30px;">
                    No prayer requests found. 
                    <?= Html::a('Submit your first request!', ['/member/create-prayer'], ['style' => 'color:#7b2ff7; font-weight:600;']) ?>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><?= Html::a('← Back to Dashboard', ['/member/dashboard'], ['class' => 'btn btn-default']) ?></p>
</div>
