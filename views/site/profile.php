<?php
use yii\helpers\Html;
$this->title = 'My Profile';
$member = \app\models\Members::findOne(['user_id' => $user->id]);
?>

<div style="padding-top:70px;">

    <div style="background:linear-gradient(135deg, #e74a3b 0%, #c0392b 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px;">
        <h2 style="margin:0;">👤 My Profile</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">Your account and personal information</p>
    </div>

    <!-- Account Info -->
    <div class="row">
        <div class="col-md-6" style="margin-bottom:20px;">
            <div style="background:white; border-radius:12px; padding:25px; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
                <h5 style="color:#e74a3b; border-bottom:2px solid #e74a3b; padding-bottom:10px; margin:0 0 15px 0;">🔑 Account Information</h5>
                <table class="table" style="font-size:14px;">
                    <tr><th style="width:40%;">Username</th><td><?= Html::encode($user->username) ?></td></tr>
                    <tr><th>Email</th><td><?= Html::encode($user->email) ?></td></tr>
                    <tr><th>Role</th><td><span style="background:#e8f4fd; color:#4e73df; padding:3px 10px; border-radius:10px; font-size:12px;"><?= Html::encode($user->role) ?></span></td></tr>
                    <tr><th>Status</th><td><span style="background:#d4edda; color:#155724; padding:3px 10px; border-radius:10px; font-size:12px;"><?= $user->status == 1 ? 'Active' : 'Inactive' ?></span></td></tr>
                </table>
            </div>
        </div>

        <div class="col-md-6" style="margin-bottom:20px;">
            <div style="background:white; border-radius:12px; padding:25px; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
                <h5 style="color:#4e73df; border-bottom:2px solid #4e73df; padding-bottom:10px; margin:0 0 15px 0;">👤 Personal Information</h5>
                <?php if ($member): ?>
                <table class="table" style="font-size:14px;">
                    <tr><th style="width:40%;">Full Name</th><td><?= Html::encode($member->first_name . ' ' . $member->last_name) ?></td></tr>
                    <tr><th>Gender</th><td><?= Html::encode($member->gender) ?></td></tr>
                    <tr><th>Date of Birth</th><td><?= Html::encode($member->dob) ?></td></tr>
                    <tr><th>Phone</th><td><?= Html::encode($member->phone) ?></td></tr>
                    <tr><th>Email</th><td><?= Html::encode($member->email) ?></td></tr>
                    <tr><th>Address</th><td><?= Html::encode($member->address) ?></td></tr>
                    <tr><th>Marital Status</th><td><?= Html::encode($member->marital_status) ?></td></tr>
                    <tr><th>Member Since</th><td><?= Html::encode($member->membership_date) ?></td></tr>
                </table>
                <?= Html::a('✏️ Edit Profile', ['/site/edit-profile'], [
                    'style' => 'background:#4e73df; color:white; padding:10px 25px; border-radius:8px; text-decoration:none; font-weight:700; font-size:14px;'
                ]) ?>
                <?php else: ?>
                <div style="text-align:center; padding:20px;">
                    <p style="color:#888;">No personal information found.</p>
                    <?= Html::a('➕ Complete Profile', ['/site/complete-profile'], [
                        'style' => 'background:#1cc88a; color:white; padding:10px 25px; border-radius:8px; text-decoration:none; font-weight:700;'
                    ]) ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?= Html::a('← Back to Dashboard', ['/member/dashboard'], [
        'style' => 'background:#6c757d; color:white; padding:10px 25px; border-radius:8px; text-decoration:none; font-weight:600;'
    ]) ?>

</div>