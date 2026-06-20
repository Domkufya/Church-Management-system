<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;

$this->title = 'Attendance Management';
?>

<div class="attendance-index">

    <!-- HERO -->
    <div style="
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        color:#fff;
        padding:30px;
        border-radius:15px;
        margin-bottom:20px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    ">
        <div>
            <h2 style="margin:0;">📋 <?= Html::encode($this->title) ?></h2>
            <p style="margin:5px 0 0; opacity:0.7;">Church Attendance Records</p>
        </div>

        <?= Html::a('➕ Record Attendance', ['create'], [
            'style' => 'background:#4e73df; color:#fff; padding:10px 20px; border-radius:20px; text-decoration:none;'
        ]) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => SerialColumn::class],

            [
                'label' => 'Event',
                'value' => function($m) {
                    return $m->event->title ?? 'N/A';
                }
            ],

            [
                'label' => 'Member',
                'value' => function($m) {
                    $name = trim(($m->member->first_name ?? '') . ' ' . ($m->member->last_name ?? ''));
                    return $name ?: 'Unknown';
                }
            ],

            'status',
            'recorded_at:datetime',

            [
    'class' => 'yii\grid\ActionColumn',
    'urlCreator' => function ($action, $model, $key, $index) {
        return \yii\helpers\Url::toRoute([$action, 'id' => $model->id]);
    }
],
        ],
    ]); ?>

</div>