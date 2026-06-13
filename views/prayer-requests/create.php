<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PrayerRequests $model */

$this->title = 'Submit New Prayer Request';
$this->params['breadcrumbs'][] = ['label' => 'Prayer Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prayer-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
