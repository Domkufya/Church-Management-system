<?php
<<<<<<< HEAD
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
=======

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;

$this->title = 'Prayer Requests Management';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="prayer-requests-index">

    <!-- HERO SECTION -->
    <div style="
        background: linear-gradient(135deg, rgba(15,15,35,0.85), rgba(30,20,60,0.85)),
                    url('https://images.unsplash.com/photo-1438232992991-995b671e4668?w=1200') center/cover;
        border-radius: 16px;
        padding: 40px 30px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    ">
        <div>
            <h1 style="color:#fff; font-size:2.2rem; margin:0;">
                🙏 <?= Html::encode($this->title) ?>
            </h1>
            <p style="color:rgba(255,255,255,0.7); margin:8px 0 0;">
                Management Panel: Below is the list of all prayer requests submitted by church members.
            </p>
        </div>
        <?= Html::a('Submit New Request ➕', ['create'], [
            'class' => 'btn',
            'style' => 'background:#4f8ef7; color:#fff; border-radius:25px; padding:12px 24px; font-weight:bold; text-decoration:none;'
        ]) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-hover align-middle', 'style' => 'background:#1e1e2e; color:#fff; border-radius:12px; overflow:hidden;'],
        'headerRowOptions' => ['style' => 'background:#2a2a4a; color:#fff;'],
        'columns' => [
            ['class' => SerialColumn::class],

            [
                'label' => 'Member Name',
                'headerOptions' => ['style' => 'color:#a0a0ff; background:#2a2a4a;'],
                'contentOptions' => ['style' => 'color:#fff;'],
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->is_anonymous) {
                        return '<span style="color:#aaa; font-style:italic;">🙈 Anonymous</span>';
                    }
                    if ($model->member && $model->member->first_name) {
                        return '👤 ' . Html::encode($model->member->first_name . ' ' . $model->member->last_name);
                    }
                    return '👤 Member #' . $model->member_id;
                },
            ],
            [
                'attribute' => 'request',
                'label' => 'Prayer Request',
                'headerOptions' => ['style' => 'color:#a0a0ff; background:#2a2a4a;'],
                'contentOptions' => ['style' => 'color:#ccc; max-width:300px;'],
                'value' => function($model) {
                    return strlen($model->request) > 80
                        ? substr($model->request, 0, 80) . '...'
                        : $model->request;
                },
            ],
            [
                'attribute' => 'status',
                'label' => 'Status',
                'headerOptions' => ['style' => 'color:#a0a0ff; background:#2a2a4a;'],
                'format' => 'raw',
                'value' => function($model) {
                    $colors = [
                        'Pending'  => '#e67e22',
                        'Prayed'   => '#2980b9',
                        'Answered' => '#27ae60',
                    ];
                    $color = $colors[$model->status] ?? '#888';
                    return '<span style="background:' . $color . '; color:#fff; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:bold;">'
                        . $model->status . '</span>';
                },
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Date',
                'headerOptions' => ['style' => 'color:#a0a0ff; background:#2a2a4a;'],
                'contentOptions' => ['style' => 'color:#ccc;'],
            ],
            [
                'class' => ActionColumn::class,
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#a0a0ff; background:#2a2a4a;'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url) {
                        return Html::a('👁', $url, ['style' => 'background:#4f8ef7; color:#fff; padding:6px 10px; border-radius:8px; margin:2px; text-decoration:none;']);
                    },
                    'update' => function($url) {
                        return Html::a('✏️', $url, ['style' => 'background:#f39c12; color:#fff; padding:6px 10px; border-radius:8px; margin:2px; text-decoration:none;']);
                    },
                    'delete' => function($url) {
                        return Html::a('🗑', $url, [
                            'style' => 'background:#e74c3c; color:#fff; padding:6px 10px; border-radius:8px; margin:2px; text-decoration:none;',
                            'data' => ['confirm' => 'Una uhakika kutaka kufuta?', 'method' => 'post'],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e

</div>