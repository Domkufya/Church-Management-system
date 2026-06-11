<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PrayerRequest $model */

$this->title = 'Update Prayer Request: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Prayer Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prayer-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
