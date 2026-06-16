<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

$role = Yii::$app->user->isGuest ? 'guest' : Yii::$app->user->identity->role;

if ($role === 'member') {
    $items = [
        ['label' => 'Home', 'url' => ['/member/dashboard']],
        ['label' => 'Announcements', 'url' => ['/events/index']],
        ['label' => 'Prayer Requests', 'url' => ['/prayer-requests/index']],
<<<<<<< HEAD
        ['label' => 'Departments', 'url' => ['/departments/index']],
        ['label' => 'Offerings', 'url' => ['/site/offerings']],
        ['label' => 'Profile', 'url' => ['/users/view', 'id' => Yii::$app->user->id]],
=======
        ['label' => 'Offerings', 'url' => ['/site/offerings']],
        ['label' => 'Profile', 'url' => ['/site/profile']],
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
        [
            'label' => 'Logout (' . Html::encode(Yii::$app->user->identity->username) . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post', 'class' => 'nav-link logout'],
        ],
    ];
} else {
    $items = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Members', 'url' => ['/members/index']],
        [
            'label' => 'Finance',
            'items' => [
                ['label' => 'Offerings', 'url' => ['/offerings/index']],
                ['label' => 'Expenses', 'url' => ['/expenses/index']],
            ],
        ],
        ['label' => 'Events', 'url' => ['/events/index']],
        [
            'label' => 'More',
            'items' => [
                ['label' => 'Attendance', 'url' => ['/attendance/index']],
                ['label' => 'Departments', 'url' => ['/departments/index']],
                ['label' => 'Children', 'url' => ['/children/index']],
                ['label' => 'Prayer Requests', 'url' => ['/prayer-requests/index']],
            ],
        ],
        [
<<<<<<< HEAD
=======
            'label' => 'Profile',
            'url' => ['/site/profile'],
            'visible' => !Yii::$app->user->isGuest,
        ],
        [
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
            'label' => 'Login',
            'url' => ['/site/login'],
            'visible' => Yii::$app->user->isGuest,
        ],
        [
            'label' => 'Logout (' . Html::encode(Yii::$app->user->identity?->username) . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post', 'class' => 'nav-link logout'],
            'visible' => !Yii::$app->user->isGuest,
        ],
    ];
}
?>
<header id="header">
    <?php NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]) ?>
    <?= Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto'],
        'encodeLabels' => false,
        'items' => $items,
    ]) ?>
    <?= Html::button('&#127769;', [
        'id' => 'theme-toggle',
        'class' => 'btn btn-link nav-link fs-5',
        'aria-label' => 'Switch to dark mode',
    ]) ?>
    <?php NavBar::end() ?>
</header>