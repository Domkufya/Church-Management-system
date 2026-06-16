<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
$this->title = 'Faith Christian Church';
?>

<div style="min-height: 100vh; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); margin-top:-20px; padding-top:80px;">

    <!-- Hero Section -->
    <div style="text-align:center; padding: 60px 20px 40px 20px; color:white;">
        <div style="font-size:70px; margin-bottom:15px;">⛪</div>
        <h1 style="font-size:42px; font-weight:800; margin:0; letter-spacing:2px;">Faith Christian Church</h1>
        <p style="font-size:18px; opacity:0.8; margin:15px 0 5px 0;">Church Management System</p>
        <p style="font-size:14px; opacity:0.6; margin:0; font-style:italic;">"For where two or three gather in my name, there am I with them." — Matthew 18:20</p>

        <div style="margin-top:35px;">
            <?= Html::a('🔑 Login', ['/site/login'], [
                'style' => 'background:#e74a3b; color:white; padding:14px 40px; border-radius:30px; text-decoration:none; font-size:16px; font-weight:700; margin:8px; display:inline-block; box-shadow:0 4px 15px rgba(231,74,59,0.4);'
            ]) ?>
            <?= Html::a('📝 Register', ['/site/register'], [
                'style' => 'background:#1cc88a; color:white; padding:14px 40px; border-radius:30px; text-decoration:none; font-size:16px; font-weight:700; margin:8px; display:inline-block; box-shadow:0 4px 15px rgba(28,200,138,0.4);'
            ]) ?>
        </div>
    </div>

    <!-- Features Section -->
    <div style="max-width:1100px; margin:0 auto; padding:20px 20px 60px 20px;">
        <h3 style="text-align:center; color:white; margin-bottom:30px; opacity:0.9;">What We Offer</h3>

        <div class="row">
            <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
                <div style="background:rgba(255,255,255,0.08); border-radius:15px; padding:25px; text-align:center; border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px; margin-bottom:12px;">📢</div>
                    <h5 style="color:white; font-weight:700; margin:0 0 8px 0;">Announcements</h5>
                    <p style="color:rgba(255,255,255,0.6); font-size:13px; margin:0;">Stay updated with church events and announcements</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
                <div style="background:rgba(255,255,255,0.08); border-radius:15px; padding:25px; text-align:center; border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px; margin-bottom:12px;">🙏</div>
                    <h5 style="color:white; font-weight:700; margin:0 0 8px 0;">Prayer Requests</h5>
                    <p style="color:rgba(255,255,255,0.6); font-size:13px; margin:0;">Submit and view prayer requests from the community</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
                <div style="background:rgba(255,255,255,0.08); border-radius:15px; padding:25px; text-align:center; border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px; margin-bottom:12px;">💰</div>
                    <h5 style="color:white; font-weight:700; margin:0 0 8px 0;">Offerings</h5>
                    <p style="color:rgba(255,255,255,0.6); font-size:13px; margin:0;">Easy ways to give your offerings via mobile money or bank</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
                <div style="background:rgba(255,255,255,0.08); border-radius:15px; padding:25px; text-align:center; border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px; margin-bottom:12px;">👥</div>
                    <h5 style="color:white; font-weight:700; margin:0 0 8px 0;">Member Management</h5>
                    <p style="color:rgba(255,255,255,0.6); font-size:13px; margin:0;">Manage church members and their information</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
                <div style="background:rgba(255,255,255,0.08); border-radius:15px; padding:25px; text-align:center; border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px; margin-bottom:12px;">📊</div>
                    <h5 style="color:white; font-weight:700; margin:0 0 8px 0;">Attendance</h5>
                    <p style="color:rgba(255,255,255,0.6); font-size:13px; margin:0;">Track member attendance for church services</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
                <div style="background:rgba(255,255,255,0.08); border-radius:15px; padding:25px; text-align:center; border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px; margin-bottom:12px;">🏛️</div>
                    <h5 style="color:white; font-weight:700; margin:0 0 8px 0;">Departments</h5>
                    <p style="color:rgba(255,255,255,0.6); font-size:13px; margin:0;">Organize and manage church departments</p>
                </div>
            </div>
        </div>

        <!-- Bottom CTA -->
        <div style="text-align:center; margin-top:20px; padding:30px; background:rgba(255,255,255,0.05); border-radius:15px; border:1px solid rgba(255,255,255,0.1);">
            <h4 style="color:white; margin:0 0 10px 0;">Ready to get started?</h4>
            <p style="color:rgba(255,255,255,0.6); margin:0 0 20px 0;">Join Faith Christian Church Management System today</p>
            <?= Html::a('Create Account Now', ['/site/register'], [
                'style' => 'background:linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:white; padding:12px 35px; border-radius:25px; text-decoration:none; font-size:15px; font-weight:700; box-shadow:0 4px 15px rgba(102,126,234,0.4);'
            ]) ?>
        </div>
    </div>

</div>