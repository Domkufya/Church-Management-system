<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Events;

$this->title = 'Announcements & Events';
$events = Events::find()->orderBy(['event_date' => SORT_DESC])->all();
?>

<div style="padding-top:70px;">

    <div style="background:linear-gradient(135deg, #4e73df 0%, #224abe 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px; box-shadow:0 4px 15px rgba(78,115,223,0.4);">
        <h2 style="margin:0; font-size:26px;">📢 Announcements & Events</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">Stay updated with all Faith Christian Church events</p>
    </div>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== 'member'): ?>
    <div style="margin-bottom:20px;">
        <?= Html::a('➕ Create New Event', ['create'], [
            'style' => 'background:#1cc88a; color:white; padding:10px 25px; border-radius:8px; text-decoration:none; font-weight:700; font-size:14px;'
        ]) ?>
    </div>
    <?php endif; ?>

    <?php if (empty($events)): ?>
        <div style="background:white; border-radius:12px; padding:40px; text-align:center; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
            <div style="font-size:50px; margin-bottom:15px;">📭</div>
            <p style="color:#888; font-size:16px;">No announcements yet. Check back soon!</p>
        </div>
    <?php else: ?>

    <div class="row">
        <?php foreach ($events as $event): ?>
        <div class="col-md-6" style="margin-bottom:20px;">
            <div style="background:white; border-radius:12px; padding:0; box-shadow:0 3px 15px rgba(0,0,0,0.1); overflow:hidden; height:100%;">
                <div style="background:linear-gradient(135deg, #4e73df 0%, #224abe 100%); padding:15px 20px;">
                    <h5 style="color:white; margin:0; font-size:16px; font-weight:700;">📅 <?= Html::encode($event->title) ?></h5>
                    <p style="color:rgba(255,255,255,0.8); margin:5px 0 0 0; font-size:12px;"><?= Html::encode($event->type ?? 'Event') ?></p>
                </div>
                <div style="padding:20px;">
                    <p style="color:#555; font-size:14px; margin:0 0 15px 0; line-height:1.6;">
                        <?= Html::encode($event->description ?? 'No description available') ?>
                    </p>
                    <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:15px;">
                        <span style="background:#e8f4fd; color:#4e73df; padding:5px 12px; border-radius:20px; font-size:12px; font-weight:600;">📅 <?= Html::encode($event->event_date) ?></span>
                        <?php if ($event->start_time): ?>
                        <span style="background:#e8f8f0; color:#1cc88a; padding:5px 12px; border-radius:20px; font-size:12px; font-weight:600;">⏰ <?= Html::encode($event->start_time) ?></span>
                        <?php endif; ?>
                        <?php if ($event->location): ?>
                        <span style="background:#fef9e7; color:#f0a500; padding:5px 12px; border-radius:20px; font-size:12px; font-weight:600;">📍 <?= Html::encode($event->location) ?></span>
                        <?php endif; ?>
                    </div>
                    <div style="display:flex; gap:8px;">
                        <?= Html::a('👁 View', Url::toRoute(['view', 'id' => $event->id]), [
                            'style' => 'background:#4e73df; color:white; padding:7px 15px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;'
                        ]) ?>
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== 'member'): ?>
                        <?= Html::a('✏️ Edit', Url::toRoute(['update', 'id' => $event->id]), [
                            'style' => 'background:#f6c23e; color:white; padding:7px 15px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;'
                        ]) ?>
                        <?= Html::a('🗑 Delete', Url::toRoute(['delete', 'id' => $event->id]), [
                            'style' => 'background:#e74a3b; color:white; padding:7px 15px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;',
                            'data' => ['confirm' => 'Are you sure?', 'method' => 'post'],
                        ]) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>

</div>
