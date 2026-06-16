<?php
<<<<<<< HEAD
use app\models\Departments;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Departments';
$departments = Departments::find()->all();
?>

<div style="padding-top:70px;">

    <!-- Header -->
    <div style="background:linear-gradient(135deg, #36b9cc 0%, #1a8a9e 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px; box-shadow:0 4px 15px rgba(54,185,204,0.4);">
        <h2 style="margin:0; font-size:26px;">🏛️ Church Departments</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">Join a department and serve God with your gifts</p>
    </div>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== 'member'): ?>
    <div style="margin-bottom:20px;">
        <?= Html::a('➕ Create Department', ['create'], [
            'style' => 'background:#36b9cc; color:white; padding:10px 25px; border-radius:8px; text-decoration:none; font-weight:700; font-size:14px;'
        ]) ?>
    </div>
    <?php endif; ?>

    <?php if (empty($departments)): ?>
        <div style="background:white; border-radius:12px; padding:40px; text-align:center; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
            <div style="font-size:50px; margin-bottom:15px;">🏛️</div>
            <p style="color:#888; font-size:16px;">No departments yet.</p>
        </div>
    <?php else: ?>

    <div class="row">
        <?php foreach ($departments as $dept): ?>
        <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
            <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 3px 15px rgba(0,0,0,0.08); height:100%;">
                <div style="background:linear-gradient(135deg, #36b9cc 0%, #1a8a9e 100%); padding:20px; text-align:center;">
                    <div style="font-size:40px; margin-bottom:8px;">🏛️</div>
                    <h5 style="color:white; margin:0; font-weight:700;"><?= Html::encode($dept->name) ?></h5>
                </div>
                <div style="padding:20px;">
                    <p style="color:#666; font-size:13px; margin:0 0 15px 0;">
                        <?= Html::encode($dept->description ?? 'No description') ?>
                    </p>

                    <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:15px;">
                        <?php if ($dept->created_at): ?>
                        <span style="background:#e8f8f0; color:#36b9cc; padding:4px 12px; border-radius:20px; font-size:12px;">
                            📅 <?= date('d M Y', strtotime($dept->created_at)) ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <div style="display:flex; gap:8px; flex-wrap:wrap;">
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'member'): ?>
                        <?= Html::a('✋ Join Department', ['/departments/join', 'id' => $dept->id], [
                            'style' => 'background:#1cc88a; color:white; padding:7px 15px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;',
                            'data' => ['confirm' => 'Request to join ' . $dept->name . '?', 'method' => 'post'],
                        ]) ?>
                        <?php else: ?>
                        <?= Html::a('👁 View', Url::toRoute(['view', 'id' => $dept->id]), [
                            'style' => 'background:#36b9cc; color:white; padding:7px 15px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;'
                        ]) ?>
                        <?= Html::a('✏️ Edit', Url::toRoute(['update', 'id' => $dept->id]), [
                            'style' => 'background:#f6c23e; color:white; padding:7px 15px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;'
                        ]) ?>
                        <?= Html::a('🗑 Delete', Url::toRoute(['delete', 'id' => $dept->id]), [
                            'style' => 'background:#e74a3b; color:white; padding:7px 15px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600;',
                            'data' => ['confirm' => 'Are you sure?', 'method' => 'post'],
                        ]) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>

</div>
=======

use app\models\Departments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DepartmentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Departments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'leader_id',
            'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Departments $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
