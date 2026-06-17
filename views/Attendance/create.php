<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Attendance $model */

<<<<<<< HEAD
$this->title = 'Register Attendance';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="attendance-create" style="max-width: 600px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

    <h2 style="margin-bottom: 20px; border-bottom: 2px solid #f4f4f4; padding-bottom: 10px;">
        <?= Html::encode($this->title) ?>
    </h2>

    <p style="color: #666;">
        Please select the event you are attending to confirm your presence.
    </p>
=======
$this->title = 'Create Attendance';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-create">

    <h1><?= Html::encode($this->title) ?></h1>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
