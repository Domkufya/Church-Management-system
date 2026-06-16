<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Offerings $model */

$this->title = 'Create Offerings';
$this->params['breadcrumbs'][] = ['label' => 'Offerings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offerings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
