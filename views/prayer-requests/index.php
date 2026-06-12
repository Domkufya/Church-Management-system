<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;

$this->title = 'Church Prayer Requests Panel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prayer-requests-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p class="text-muted" style="margin-bottom: 20px;">
        Management Panel: Below is the list of all prayer requests submitted by church members.
    </p>

    <p>
        <?= Html::a('Submit New Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],
            'id',
            'member_id',
            'request:ntext',
            'is_anonymous',
            'status',
            'created_at',
            ['class' => ActionColumn::class],
        ],
    ]); ?>

</div>
