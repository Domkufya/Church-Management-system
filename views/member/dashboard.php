<?php
use yii\helpers\Html;
$this->title = 'Member Dashboard';
?>

<div style="padding-top: 70px;">

    <!-- Welcome Bar -->
    <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; padding: 25px 30px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(17,153,142,0.3);">
        <h2 style="margin:0; font-size:24px;">⛪ Faith Christian Church</h2>
        <p style="margin:8px 0 0 0; opacity:0.9; font-size:15px;">Welcome, <?= Html::encode($user->username) ?>! — <?= date('l, d F Y') ?></p>
        <p style="margin:5px 0 0 0; opacity:0.8; font-size:13px;">🙏 "For where two or three gather in my name, there am I with them." — Matthew 18:20</p>
    </div>

    <!-- Quick Access Cards -->
    <h5 style="color:#555; margin-bottom:15px; font-weight:600;">📌 Quick Access</h5>
    <div class="row">

        <div class="col-xs-6 col-md-3" style="margin-bottom:20px;">
            <div style="background:#fff; border-radius:12px; padding:25px 20px; box-shadow:0 3px 12px rgba(0,0,0,0.08); border-top:4px solid #4e73df; text-align:center; transition:all 0.3s;">
                <div style="font-size:40px; margin-bottom:10px;">📢</div>
                <h5 style="color:#4e73df; font-weight:700; margin:0 0 8px 0;">Announcements</h5>
                <p style="color:#888; font-size:13px; margin:0 0 15px 0;">View church announcements & events</p>
                <?= Html::a('View →', ['/events/index'], ['style' => 'background:#4e73df; color:white; padding:8px 20px; border-radius:20px; text-decoration:none; font-size:13px; font-weight:600;']) ?>
            </div>
        </div>

        <div class="col-xs-6 col-md-3" style="margin-bottom:20px;">
            <div style="background:#fff; border-radius:12px; padding:25px 20px; box-shadow:0 3px 12px rgba(0,0,0,0.08); border-top:4px solid #1cc88a; text-align:center;">
                <div style="font-size:40px; margin-bottom:10px;">🙏</div>
                <h5 style="color:#1cc88a;