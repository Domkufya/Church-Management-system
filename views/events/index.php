<?php

use app\models\Events;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EventsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== 'member'): ?>
<p>
    <?= Html::a('Create Events', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?php endif; ?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'event_date',
            'start_time',
            //'end_time',
            //'location',
            //'type',
            //'created_at',
            
        [
    'class' => ActionColumn::className(),
    'template' => Yii::$app->user->identity->role === 'member' ? '{view}' : '{view} {update} {delete}',
    'urlCreator' => function ($action, Events $model, $key, $index, $column) {
        return Url::toRoute([$action, 'id' => $model->id]);
    }
],
 ],
]);?>



</div>
