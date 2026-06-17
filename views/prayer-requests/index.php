<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;

$this->title = 'Prayer Requests Management';
?>

<div class="prayer-requests-index">

    <!-- HERO -->
    <div style="
        background: linear-gradient(135deg, #2c3e50, #4a2c82);
        color:#fff;
        padding:30px;
        border-radius:12px;
        margin-bottom:20px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    ">
        <div>
            <h2 style="margin:0;">🙏 <?= Html::encode($this->title) ?></h2>
            <p style="margin:5px 0 0; opacity:0.8;">Manage all prayer requests</p>
        </div>

        <?= Html::a('➕ New Request', ['create'], [
            'style' => 'background:#4f8ef7; color:#fff; padding:10px 20px; border-radius:20px; text-decoration:none;'
        ]) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => SerialColumn::class],

            [
                'attribute' => 'member_id',
                'label' => 'Member',
                'value' => function($model) {
                    return $model->is_anonymous
                        ? '🙈 Anonymous'
                        : ($model->member->first_name ?? 'Member #' . $model->member_id);
                }
            ],

            'request:ntext',

            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status;
                }
            ],

            'created_at:date',

            [
                'class' => ActionColumn::class,
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>