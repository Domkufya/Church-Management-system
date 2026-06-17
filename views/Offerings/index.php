<?php

use app\models\offerings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;

$this->title = 'Offerings';
$offeringsList = offerings::find()->orderBy(['offering_date' => SORT_DESC])->all();
?>

<div style="padding-top:70px;">

    <div style="background:linear-gradient(135deg, #1cc88a 0%, #17a673 100%); color:white; padding:25px 30px; border-radius:12px; margin-bottom:25px; box-shadow:0 4px 15px rgba(28,200,138,0.4);">
        <h2 style="margin:0; font-size:26px;">💰 Offerings</h2>
        <p style="margin:8px 0 0 0; opacity:0.85; font-size:14px;">Record and manage church offerings</p>
    </div>

    <div style="margin-bottom:20px;">
        <?= Html::a('➕ Add Offering', ['create'], [
            'style' => 'background:#1cc88a; color:white; padding:10px 25px; border-radius:8px; text-decoration:none; font-weight:700; font-size:14px;'
        ]) ?>
    </div>

    <?php if (empty($offeringsList)): ?>
        <div style="background:white; border-radius:12px; padding:40px; text-align:center; box-shadow:0 3px 12px rgba(0,0,0,0.08);">
            <div style="font-size:50px; margin-bottom:15px;">💰</div>
            <p style="color:#888; font-size:16px;">No offerings recorded yet.</p>
        </div>
    <?php else: ?>

    <div class="row">
        <?php foreach ($offeringsList as $i => $offering): ?>
        <div class="col-md-6" style="margin-bottom:20px;">
            <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 3px 15px rgba(0,0,0,0.08);">
                <div style="background:linear-gradient(135deg, #1cc88a 0%, #17a673 100%); padding:12px 20px; display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:white; font-weight:700; font-size:14px;">💰 Offering #<?= $i + 1 ?></span>
                    <span style="background:rgba(255,255,255,0.2); color:white; padding:3px 10px; border-radius:10px; font-size:11px;">
                        <?= Html::encode($offering->type ?? 'Offering') ?>
                    </span>
                </div>
                <div style="padding:20px;">
                    <h4 style="color:#1cc88a; font-weight:800; margin:0 0 10px 0;">TZS <?= number_format($offering->amount, 0) ?></h4>
                    <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:15px;">
                        <span style="background:#e8f8f0; color:#1cc88a; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600;">
                            📅 <?= Html::encode($offering->offering_date) ?>
                        </span>
                        <span style="background:#f0f0f0; color:#666; padding:4px 12px; border-radius:20px; font-size:12px;">
                            💳 <?= Html::encode($offering->payment_method ?? 'Cash') ?>
                        </span>
                    </div>
                    <?php if ($offering->notes): ?>
                    <p style="color:#777; font-size:13px; margin:0 0 15px 0;"><?= Html::encode($offering->notes) ?></p>
                    <?php endif; ?>
                    <div style="display:flex; gap:8px;">
                        <?= Html::a('👁 View', Url::toRoute(['view', 'id' => $offering->id]), [
                            'style' => 'background:#1cc88a; color:white; padding:6px 14px; border-radius:8px; text-decoration:none; font-size:12px; font-weight:600;'
                        ]) ?>
                        <?= Html::a('✏️ Edit', Url::toRoute(['update', 'id' => $offering->id]), [
                            'style' => 'background:#f6c23e; color:white; padding:6px 14px; border-radius:8px; text-decoration:none; font-size:12px; font-weight:600;'
                        ]) ?>
                        <?= Html::a('🗑 Delete', Url::toRoute(['delete', 'id' => $offering->id]), [
                            'style' => 'background:#e74a3b; color:white; padding:6px 14px; border-radius:8px; text-decoration:none; font-size:12px; font-weight:600;',
                            'data' => ['confirm' => 'Are you sure?', 'method' => 'post'],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>

</div>
