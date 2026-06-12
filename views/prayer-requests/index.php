<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrayerRequestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prayer Requests Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prayer-request-index">

    <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 20px;">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="fa fa-plus"></i> Submit New Request', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <p class="text-muted">
        Management Panel: Below is the list of all prayer requests submitted by church members.
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'], // Lile kosa letu tulilolinyoosha mazima!

            'full_name',
            'phone_number',
            'category',
            'title',
            
            // Boresho: Kuonyesha Status kwa rangi za kuvutia (Badges)
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status === 'Answered') {
                        return '<span class="badge bg-success" style="color:white; padding:5px 10px;">Answered</span>';
                    } elseif ($model->status === 'Approved') {
                        return '<span class="badge bg-primary" style="color:white; padding:5px 10px;">Approved</span>';
                    } else {
                        return '<span class="badge bg-warning text-dark" style="padding:5px 10px;">Pending</span>';
                    }
                },
                'filter' => [
                    'Pending' => 'Pending',
                    'Approved' => 'Approved',
                    'Answered' => 'Answered'
                ], // Admin anaweza kuchuja kwa kubofya dropdown hapa hapa kwenye gridi!
            ],
            
            // 'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>