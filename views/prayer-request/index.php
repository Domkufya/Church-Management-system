<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Church Prayer Requests Panel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prayer-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p class="text-muted" style="margin-bottom: 20px;">
        Management Panel: Below is the list of all prayer requests submitted by church members.
    </p>

    <p>
        <?= Html::a('Submit New Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialNumberColumn'],

            'id',
            'title',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>