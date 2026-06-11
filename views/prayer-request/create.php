<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PrayerRequest $model */

$this->title = 'Create Prayer Request';
$this->params['breadcrumbs'][] = ['label' => 'Prayer Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prayer-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
