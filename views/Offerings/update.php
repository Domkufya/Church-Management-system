<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Offerings $model */

$this->title = 'Update Offerings: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Offerings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="offerings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
