<?php
use app\models\PrayerRequests;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Prayer Requests';
$prayers = PrayerRequests::find()->orderBy(['created_at' => SORT_DESC])->all();
?>

<div style="padding-top:70px;">

    <!-- Header -->
    <div style="background:linear-gradient(135deg, #6f42c1 0%, #4a2c82 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px; box-shadow:0 4px 15px rgba(111,66,193,0.4);">
        <h2 style="margin:0; font-size:26px;">🙏 Prayer Requests</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">"The prayer of a righteous person is powerful and effective." — James 5:16</p>
    </div>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== 'member'): ?>
    <div style="margin-bottom:20px;">
        <?= Html::a('➕ Add Prayer Request', ['create'], [
            'style' => 'background:#6f42c1; color:white; padding:10px 25px; border-radius:8px; text-decoration:none; font-weight:700; font-size:14px;'
        ]) ?>
    </div>
    <?php endif; ?>

    <?php if (empty($prayers)): ?>
        <div style="background:white; border-radius:12px; padding:40px; text-align:center; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
            <div style="font-size:50px; margin-bottom:15px;">🙏</div>
            <p style="color:#888; font-size:16px;">No prayer requests yet.</p>
        </div>
    <?php else: ?>

    <div class="row">
        <?php foreach ($prayers as $i => $prayer): ?>
        <div class="col-md-6" style="margin-bottom:20px;">
            <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 3px 15px rgba(0,0,0,0.08); height:100%;">

                <!-- Top Bar -->
                <div style="background:linear-gradient(135deg, #6f42c1 0%, #4a2c82 100%); padding:12px 20px; display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:white; font-weight:700; font-size:14px;">🙏 Prayer Request #<?= $i + 1 ?></span>
                    <span style="background:rgba(255,255,255,0.2); color:white; padding:3px 10px; border-radius:10px; font-size:11px;">
                        <?= $prayer->is_anonymous ? '🔒 Anonymous' : '👤 Named' ?>
                    </span>
                </div>

                <!-- Content -->
                <div style="padding:20px;">
                    <p style="color:#555; font-size:14px; line-height:1.7; margin:0 0 15px 0;">
                        <?= Html::encode($prayer->request) ?>
                    </p>

                    <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:15px;">
                        <span style="background:#f3e8ff; color:#6f42c1; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600;">
                            📊 <?= Html::encode($prayer->status ?? 'Pending') ?>
                        </span>
                        <?php if ($prayer->created_at): ?>
                        <span style="background:#f0f0f0; color:#666; padding:4px 12px; border-radius:20px; font-size:12px;">
                            🕐 <?= date('d M Y', strtotime($prayer->created_at)) ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== 'member'): ?>
                    <div style="display:flex; gap:8px;">
                        <?= Html::a('👁 View', Url::toRoute(['view', 'id' => $prayer->id]), [
                            'style' => 'background:#6f42c1; color:white; padding:6px 14px; border-radius:8px; text-decoration:none; font-size:12px; font-weight:600;'
                        ]) ?>
                        <?= Html::a('✏️ Edit', Url::toRoute(['update', 'id' => $prayer->id]), [
                            'style' => 'background:#f6c23e; color:white; padding:6px 14px; border-radius:8px; text-decoration:none; font-size:12px; font-weight:600;'
                        ]) ?>
                        <?= Html::a('🗑 Delete', Url::toRoute(['delete', 'id' => $prayer->id]), [
                            'style' => 'background:#e74a3b; color:white; padding:6px 14px; border-radius:8px; text-decoration:none; font-size:12px; font-weight:600;',
                            'data' => ['confirm' => 'Are you sure?', 'method' => 'post'],
                        ]) ?>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>

</div>