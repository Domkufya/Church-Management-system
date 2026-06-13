<?php

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

    <!-- TABLE -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-hover align-middle', 'style' => 'background:#1e1e2e; color:#fff; border-radius:12px; overflow:hidden;'],
        'headerRowOptions' => ['style' => 'background:#2a2a4a; color:#fff;'],
        'rowOptions' => ['style' => 'border-bottom: 1px solid rgba(255,255,255,0.1);'],
        'columns' => [
            ['class' => SerialColumn::class],

            [
                'attribute' => 'member_id',
                'label' => 'Member',
                'contentOptions' => ['style' => 'color:#fff;'],
                'headerOptions' => ['style' => 'color:#a0a0ff; background:#2a2a4a;'],
                'value' => function($model) {
                    return '👤 Member #' . $model->member_id;
                },
            ],
            [
                'attribute' => 'request',
                'label' => 'Prayer Request',
                'contentOptions' => ['style' => 'color:#ccc; max-width:300px;'],
                'headerOptions' => ['style' => 'color:#a0a0ff; background:#2a2a4a;'],
                'value' => function($model) {
                    return strlen($model->request) > 80
                        ? substr($model->request, 0, 80) . '...'
                        : $model->request;
                },
            ],
            [
                'attribute' => 'is_anonymous',
                'label' => 'Anonymous',
                'headerOptions' => ['style' => 'color:#a0a0ff; background:#2a2a4a;'],
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->is_anonymous) {
                        return '<span style="background:#555; color:#fff; padding:4px 10px; border-radius:20px; font-size:12px;">🙈 Yes</span>';
                    }
                    return '<span style="background:#2d6a4f; color:#fff; padding:4px 10px; border-radius:20px; font-size:12px;">👁 No</span>';
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

</div>