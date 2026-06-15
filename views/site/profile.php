<?php
use yii\helpers\Html;
$this->title = 'My Profile';
?>

<div style="padding-top:70px;">
    <div style="background:linear-gradient(135deg, #e74a3b 0%, #c0392b 100%); color:white; padding:20px 25px; border-radius:12px; margin-bottom:25px;">
        <h3 style="margin:0;">👤 My Profile</h3>
    </div>

    <div style="background:white; border-radius:12px; padding:25px; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
        <table class="table">
            <tr><th>Username</th><td><?= Html::encode($user->username) ?></td></tr>
            <tr><th>Email</th><td><?= Html::encode($user->email) ?></td></tr>
            <tr><th>Role</th><td><?= Html::encode($user->role) ?></td></tr>
            <tr><th>Status</th><td><?= $user->status == 1 ? 'Active' : 'Inactive' ?></td></tr>
        </table>
    </div>
</div>