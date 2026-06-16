<?php

<<<<<<< HEAD
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

            // Event Name instead of ID
            [
                'attribute' => 'event_id',
                'label' => 'Event Name',
                'value' => 'event.name',
            ],
            
            // Member Full Name instead of ID
            [
                'attribute' => 'member_id',
                'label' => 'Member Name',
                'value' => function($model) {
                    return $model->member->first_name . ' ' . $model->member->last_name;
                },
            ],
            
            // Gender field
            [
                'label' => 'Gender',
                'value' => 'member.gender',
            ],

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
=======
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Attendance $model */

$this->title = 'Update Attendance: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attendance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
