<?php
use yii\helpers\Html;
$this->title = 'Department Join Requests';
?>

<div style="padding-top:70px;">

    <div style="background:linear-gradient(135deg, #f6c23e 0%, #f0a500 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px;">
        <h2 style="margin:0;">⚠️ Pending Department Requests</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">Review and approve member requests to join departments</p>
    </div>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; margin-bottom:15px;">
            ✅ <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($requests)): ?>
        <div style="background:white; border-radius:12px; padding:40px; text-align:center;">
            <p style="color:#888;">No pending requests.</p>
        </div>
    <?php else: ?>

    <div class="row">
        <?php foreach ($requests as $request): ?>
        <div class="col-md-6" style="margin-bottom:20px;">
            <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 3px 15px rgba(0,0,0,0.08);">
                <div style="background:linear-gradient(135deg, #f6c23e 0%, #f0a500 100%); padding:12px 20px;">
                    <span style="color:white; font-weight:700;">📋 Join Request</span>
                </div>
                <div style="padding:20px;">
                    <p style="margin:0 0 8px 0;"><strong>Member:</strong> <?= Html::encode($request->member->first_name . ' ' . $request->member->last_name) ?></p>
                    <p style="margin:0 0 15px 0;"><strong>Department:</strong> <?= Html::encode($request->department->name) ?></p>

                    <div style="display:flex; gap:8px;">
                        <?= Html::a('✅ Approve', ['/departments/approve', 'id' => $request->id], [
                            'style' => 'background:#1cc88a; color:white; padding:8px 18px; border-radius:8px; text-decoration:none; font-weight:600;',
                            'data' => ['method' => 'post'],
                        ]) ?>
                        <?= Html::a('❌ Reject', ['/departments/reject', 'id' => $request->id], [
                            'style' => 'background:#e74a3b; color:white; padding:8px 18px; border-radius:8px; text-decoration:none; font-weight:600;',
                            'data' => ['method' => 'post'],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>

</div>