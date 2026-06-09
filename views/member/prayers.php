<?php
use yii\helpers\Html;
$this->title = 'Prayer Requests';
?>
<div class="member-prayers">
    <h2>🙏 Prayer Requests</h2>
    <hr>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Request</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prayers as $i => $prayer): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= Html::encode($prayer->request) ?></td>
                <td><?= Html::encode($prayer->created_at) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($prayers)): ?>
            <tr>
                <td colspan="3" class="text-center">No prayer requests found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><?= Html::a('← Back to Dashboard', ['/prayer-requests/index'], ['class' => 'btn btn-default']) ?></p>
</div>