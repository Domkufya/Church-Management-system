<?php
<<<<<<< HEAD
use yii\helpers\Html;
$this->title = $model->title;
?>

<div style="padding-top:70px;">

    <div style="max-width:700px; margin:0 auto;">

        <!-- Header -->
        <div style="background:linear-gradient(135deg, #4e73df 0%, #224abe 100%); color:white; padding:30px; border-radius:12px 12px 0 0;">
            <p style="margin:0 0 8px 0; opacity:0.8; font-size:13px;">📅 EVENT DETAILS</p>
            <h2 style="margin:0; font-size:24px; font-weight:800;"><?= Html::encode($model->title) ?></h2>
            <span style="background:rgba(255,255,255,0.2); padding:4px 12px; border-radius:20px; font-size:12px; margin-top:10px; display:inline-block;">
                <?= Html::encode($model->type ?? 'Event') ?>
            </span>
        </div>

        <!-- Content -->
        <div style="background:white; border-radius:0 0 12px 12px; padding:30px; box-shadow:0 5px 20px rgba(0,0,0,0.1);">

            <!-- Info Pills -->
            <div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:25px;">
                <span style="background:#e8f4fd; color:#4e73df; padding:8px 15px; border-radius:20px; font-size:13px; font-weight:600;">
                    📅 <?= Html::encode($model->event_date) ?>
                </span>
                <?php if ($model->start_time): ?>
                <span style="background:#e8f8f0; color:#1cc88a; padding:8px 15px; border-radius:20px; font-size:13px; font-weight:600;">
                    ⏰ Start: <?= Html::encode($model->start_time) ?>
                </span>
                <?php endif; ?>
                <?php if ($model->end_time): ?>
                <span style="background:#fff5f5; color:#e74a3b; padding:8px 15px; border-radius:20px; font-size:13px; font-weight:600;">
                    ⏰ End: <?= Html::encode($model->end_time) ?>
                </span>
                <?php endif; ?>
                <?php if ($model->location): ?>
                <span style="background:#fef9e7; color:#f0a500; padding:8px 15px; border-radius:20px; font-size:13px; font-weight:600;">
                    📍 <?= Html::encode($model->location) ?>
                </span>
                <?php endif; ?>
            </div>

            <!-- Description -->
            <div style="background:#f8f9fc; border-radius:10px; padding:20px; margin-bottom:25px;">
                <h6 style="color:#444; font-weight:700; margin:0 0 10px 0;">📝 Description</h6>
                <p style="color:#555; font-size:15px; line-height:1.7; margin:0;">
                    <?= nl2br(Html::encode($model->description ?? 'No description available')) ?>
                </p>
            </div>

            <!-- Back Button -->
            <?= Html::a('← Back to Events', ['index'], [
                'style' => 'background:#4e73df; color:white; padding:10px 25px; border-radius:8px; text-decoration:none; font-weight:700; font-size:14px;'
            ]) ?>

        </div>
    </div>
</div>
=======

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Events $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="events-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'event_date',
            'start_time',
            'end_time',
            'location',
            'type',
            'created_at',
        ],
    ]) ?>

</div>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
