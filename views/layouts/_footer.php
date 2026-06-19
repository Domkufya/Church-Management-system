<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

// Guests see no footer — landing page is self-contained
if (Yii::$app->user->isGuest) {
    return;
}
?>
<footer class="app-footer">
    <div class="app-footer-left">
        <strong>✝ <?= Html::encode(Yii::$app->name) ?></strong>
        &nbsp;·&nbsp; &copy; <?= date('Y') ?> All rights reserved.
    </div>
    <div class="app-footer-verse">
        "Let everything be done for the glory of God." — <span style="color:var(--c-gold);">1 Cor 10:31</span>
    </div>
    <div class="app-footer-right">
        <?= Yii::t('yii', 'Powered by {yii}', ['yii' => '']) ?>
        <?= Html::img('@web/images/yii3_full_for_light.svg', [
            'alt'    => 'Yii Framework',
            'class'  => 'footer-logo-light',
            'height' => '20',
        ]) ?>
        <?= Html::img('@web/images/yii3_full_for_dark.svg', [
            'alt'    => 'Yii Framework',
            'class'  => 'footer-logo-dark',
            'height' => '20',
        ]) ?>
    </div>
</footer>