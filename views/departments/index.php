<?php
use app\models\Departments;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Departments';
$departments = Departments::find()->all();
?>

<div style="padding-top:70px;">

    <div style="background:linear-gradient(135deg, #36b9cc 0%, #1a8a9e 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px; box-shadow:0 4px 15px rgba(54,185,204,0.4);">
        <h2 style="margin:0; font-size:26px;">🏛️ Church Departments</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">Join a department and serve God with your gifts</p>
    </div>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; margin-bottom:15px;">
            ✅ <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:8px; margin-bottom:15px;">
            ❌ <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

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