<?php
use yii\helpers\Html;
$this->title = 'Update Attendance';
?>

<div style="padding-top:70px;">

    <div style="background:linear-gradient(135deg, #4e73df 0%, #224abe 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px;">
        <h2 style="margin:0;">✏️ Update Attendance</h2>
    </div>

    <div style="background:white; border-radius:12px; padding:30px; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>

</div>