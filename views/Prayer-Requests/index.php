<?php

use app\models\PrayerRequests;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PrayerRequestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Prayer Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prayer-requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== 'member'): ?>
<p>
    <?= Html::a('Create Prayer Requests', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'member_id',
            'request:ntext',
            'is_anonymous',
            'status',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'template' => Yii::$app->user->identity->role === 'member' ? '{view}' : '{view} {update} {delete}',
                'urlCreator' => function ($action, PrayerRequests $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
