<?php
<<<<<<< HEAD
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;

$this->title = 'Attendance List';
?>

<div class="attendance-index">

    <!-- HERO SECTION -->
    <div style="
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        border-radius: 20px;
        padding: 40px 35px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    ">
        <div style="display:flex; align-items:center; gap:15px;">
            <div style="background:rgba(78,115,223,0.2); padding:12px; border-radius:12px; font-size:2rem;">📋</div>
            <div>
                <h1 style="color:#fff; font-size:2rem; margin:0; font-weight:800;">Attendance Management</h1>
                <p style="color:rgba(255,255,255,0.6); margin:4px 0 0; font-size:14px;">⛪ Faith Christian Church — Track member attendance</p>
            </div>
        </div>
        <?= Html::a('➕ Record Attendance', ['create'], [
            'style' => 'background: linear-gradient(135deg, #4e73df, #2e59d9); color:#fff; padding:12px 24px; border-radius:25px; text-decoration:none; font-weight:700; font-size:14px; box-shadow: 0 4px 15px rgba(78,115,223,0.4); white-space:nowrap;'
        ]) ?>
    </div>

    <!-- STATS CARDS -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div style="background:#1e1e2e; border-radius:15px; padding:20px; box-shadow:0 3px 15px rgba(0,0,0,0.2); border-left:4px solid #4e73df; display:flex; align-items:center; gap:15px;">
                <div style="font-size:2.5rem;">👥</div>
                <div>
                    <div style="color:#4e73df; font-size:1.8rem; font-weight:800;"><?= $dataProvider->getTotalCount() ?></div>
                    <div style="color:#aaa; font-size:13px;">Total Records</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div style="background:#1e1e2e; border-radius:15px; padding:20px; box-shadow:0 3px 15px rgba(0,0,0,0.2); border-left:4px solid #1cc88a; display:flex; align-items:center; gap:15px;">
                <div style="font-size:2.5rem;">📅</div>
                <div>
                    <div style="color:#1cc88a; font-size:1.3rem; font-weight:800;"><?= date('d M Y') ?></div>
                    <div style="color:#aaa; font-size:13px;">Today's Date</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div style="background:#1e1e2e; border-radius:15px; padding:20px; box-shadow:0 3px 15px rgba(0,0,0,0.2); border-left:4px solid #f6c23e; display:flex; align-items:center; gap:15px;">
                <div style="font-size:2.5rem;">⛪</div>
                <div>
                    <div style="color:#f6c23e; font-size:1.3rem; font-weight:800;">Faith Church</div>
                    <div style="color:#aaa; font-size:13px;">Church Name</div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div style="background:#1e1e2e; border-radius:20px; overflow:hidden; box-shadow:0 5px 25px rgba(0,0,0,0.3);">

        <div style="background: linear-gradient(135deg, #0f3460, #1a1a2e); padding:20px 25px;">
            <h5 style="color:#fff; margin:0; font-weight:700;">📊 Attendance Records</h5>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-hover mb-0', 'style' => 'background:#1e1e2e;'],
            'headerRowOptions' => ['style' => 'background:#2a2a4a;'],
            'showHeader' => true,
            'columns' => [
                [
                    'class' => SerialColumn::class,
                    'headerOptions' => ['style' => 'color:#a0a0ff; font-weight:700; padding:15px 20px; font-size:13px; background:#2a2a4a;'],
                    'contentOptions' => ['style' => 'padding:15px 20px; color:#fff !important;'],
                ],
                [
                    'attribute' => 'event_id',
                    'label' => 'Event',
                    'headerOptions' => ['style' => 'color:#a0a0ff; font-weight:700; padding:15px 20px; font-size:13px; background:#2a2a4a;'],
                    'contentOptions' => ['style' => 'padding:15px 20px;'],
                    'format' => 'raw',
                    'value' => function($m) {
                        $title = Html::encode($m->event->title ?? 'N/A');
                        return '<div style="display:flex; align-items:center; gap:10px;">
                            <div style="background:rgba(78,115,223,0.2); padding:8px; border-radius:8px; font-size:1.2rem;">📢</div>
                            <span style="color:#ffffff !important; font-weight:600;">' . $title . '</span>
                        </div>';
                    },
                ],
                [
                    'attribute' => 'member_id',
                    'label' => 'Member',
                    'headerOptions' => ['style' => 'color:#a0a0ff; font-weight:700; padding:15px 20px; font-size:13px; background:#2a2a4a;'],
                    'contentOptions' => ['style' => 'padding:15px 20px;'],
                    'format' => 'raw',
                    'value' => function($m) {
                        $firstName = $m->member->first_name ?? 'U';
                        $lastName = $m->member->last_name ?? 'U';
                        $name = trim($firstName . ' ' . $lastName);
                        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                        $colors = ['#4e73df', '#1cc88a', '#e74c3c', '#f6c23e', '#7b2ff7'];
                        $color = $colors[abs(crc32($name)) % count($colors)];
                        return '<div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:40px; height:40px; border-radius:50%; background:' . $color . '; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:14px; flex-shrink:0;">' . $initials . '</div>
                            <span style="color:#ffffff !important; font-weight:600;">' . Html::encode($name) . '</span>
                        </div>';
                    },
                ],
                [
                    'label' => 'Gender',
                    'headerOptions' => ['style' => 'color:#a0a0ff; font-weight:700; padding:15px 20px; font-size:13px; background:#2a2a4a;'],
                    'contentOptions' => ['style' => 'padding:15px 20px;'],
                    'format' => 'raw',
                    'value' => function($m) {
                        $gender = $m->member->gender ?? 'Unknown';
                        if ($gender === 'Female') {
                            $style = 'background:#e74c3c; color:#fff;';
                            $icon = '♀️';
                        } else {
                            $style = 'background:#4e73df; color:#fff;';
                            $icon = '♂️';
                        }
                        return '<span style="' . $style . ' padding:5px 14px; border-radius:20px; font-size:12px; font-weight:600;">' . $icon . ' ' . $gender . '</span>';
                    },
                ],
                [
                    'attribute' => 'recorded_at',
                    'label' => 'Time',
                    'headerOptions' => ['style' => 'color:#a0a0ff; font-weight:700; padding:15px 20px; font-size:13px; background:#2a2a4a;'],
                    'contentOptions' => ['style' => 'padding:15px 20px;'],
                    'format' => 'raw',
                    'value' => function($m) {
                        $time = Yii::$app->formatter->asDatetime($m->recorded_at, 'php:d M Y, H:i');
                        return '<div style="display:flex; align-items:center; gap:8px;">
                            <span style="font-size:1rem;">🕐</span>
                            <span style="color:#ffffff !important; font-size:13px;">' . $time . '</span>
                        </div>';
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'headerOptions' => ['style' => 'color:#a0a0ff; font-weight:700; padding:15px 20px; font-size:13px; background:#2a2a4a;'],
                    'contentOptions' => ['style' => 'padding:15px 20px;'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function($url) {
                            return Html::a('👁', $url, ['style' => 'background:#4e73df; color:#fff; padding:6px 12px; border-radius:8px; text-decoration:none; margin:2px; display:inline-block;']);
                        },
                        'update' => function($url) {
                            return Html::a('✏️', $url, ['style' => 'background:#f6c23e; color:#fff; padding:6px 12px; border-radius:8px; text-decoration:none; margin:2px; display:inline-block;']);
                        },
                        'delete' => function($url) {
                            return Html::a('🗑', $url, [
                                'style' => 'background:#e74c3c; color:#fff; padding:6px 12px; border-radius:8px; text-decoration:none; margin:2px; display:inline-block;',
                                'data' => ['confirm' => 'Una uhakika kutaka kufuta?', 'method' => 'post'],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>

</div>

<style>
.table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.05) !important;
}
.table tbody tr:hover td {
    background: rgba(78,115,223,0.1) !important;
}
.table td {
    vertical-align: middle !important;
    color: #ffffff !important;
}
</style>
=======

use app\models\Attendance;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AttendanceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Attendances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Attendance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'event_id',
            'member_id',
            'status',
            'recorded_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Attendance $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
