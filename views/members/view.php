<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Members $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="members-view">

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
            'first_name',
            'last_name',
            'gender',
            'dob',
            'phone',
            'email:email',
            'address:ntext',
            'marital_status',
            'membership_date',
            'status',
            [
    'attribute' => 'photo',
    'value' => function($model) {
        if ($model->photo) {
            return Html::img('@web/uploads/' . $model->photo, [
                'width' => '150px',
                'style' => 'border-radius:10px'
            ]);
        }
        return 'Hakuna picha';
    },
    'format' => 'raw',
],
            'created_at',
        ],
    ]) ?>

</div>
