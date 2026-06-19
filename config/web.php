<?php

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';

$config = [
    'id'       => 'basic',
    'name'     => 'Faith Christian Church',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    // ── Controller map ───────────────────────────────────────────────
    'controllerMap' => [
        'superadmin' => [
            'class' => 'app\controllers\SuperadminController',
        ],
        'member' => [
            'class' => 'app\controllers\MemberController',
        ],
    ],

    'container' => [
        'singletons' => [
            \yii\mail\MailerInterface::class => [
                'class'            => \yii\symfonymailer\Mailer::class,
                'useFileTransport' => true,
                'viewPath'         => '@app/mail',
            ],
        ],
    ],

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'components' => [

        'request' => [
            'cookieValidationKey' => '2dJ_hO42y1MnQz8W44zX6h6pu0wwbsPq',
        ],

        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],

        'user' => [
            'identityClass'   => \app\models\User::class,
            'enableAutoLogin' => true,
            'loginUrl'        => ['/site/login'],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => \yii\mail\MailerInterface::class,

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class'  => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules' => [

                // ── Landing / guest auth ──────────────────────
                ''                  => 'site/index',
                'login'             => 'site/login',
                'logout'            => 'site/logout',
                'register'          => 'site/register',
                'complete-profile'  => 'site/complete-profile',
                'forgot-password'   => 'site/forgot-password',
                'contact'           => 'site/contact',
                'about'             => 'site/about',

                // ── Superadmin ────────────────────────────────
                'superadmin'                         => 'superadmin/dashboard',
                'superadmin/dashboard'               => 'superadmin/dashboard',
                'superadmin/users'                   => 'superadmin/users',
                'superadmin/assign-role'             => 'superadmin/assign-role',
                'superadmin/toggle-status/<id:\d+>'  => 'superadmin/toggle-status',
                'superadmin/delete-user'             => 'superadmin/delete-user',

                // ── Staff dashboard ───────────────────────────
                'dashboard'         => 'dashboard/index',

                // ── Member area ───────────────────────────────
                'member/dashboard'          => 'member/dashboard',
                'member/<action:\w+>'       => 'member/<action>',

                // ── Members CRUD ──────────────────────────────
                'members'                           => 'members/index',
                'members/<action:\w+>/<id:\d+>'     => 'members/<action>',
                'members/<action:\w+>'              => 'members/<action>',

                // ── Events CRUD ───────────────────────────────
                'events'                            => 'events/index',
                'events/<action:\w+>/<id:\d+>'      => 'events/<action>',
                'events/<action:\w+>'               => 'events/<action>',

                // ── Departments CRUD ──────────────────────────
                'departments'                           => 'departments/index',
                'departments/<action:\w+>/<id:\d+>'     => 'departments/<action>',
                'departments/<action:\w+>'              => 'departments/<action>',

                // ── Attendance CRUD ───────────────────────────
                'attendance'                            => 'attendance/index',
                'attendance/<action:\w+>/<id:\d+>'      => 'attendance/<action>',
                'attendance/<action:\w+>'               => 'attendance/<action>',

                // ── Finance ───────────────────────────────────
                'offerings'                             => 'offerings/index',
                'offerings/<action:\w+>/<id:\d+>'       => 'offerings/<action>',
                'offerings/<action:\w+>'                => 'offerings/<action>',

                'expenses'                              => 'expenses/index',
                'expenses/<action:\w+>/<id:\d+>'        => 'expenses/<action>',
                'expenses/<action:\w+>'                 => 'expenses/<action>',

                // ── Prayer Requests CRUD ──────────────────────
                'prayer-requests'                           => 'prayer-requests/index',
                'prayer-requests/<action:\w+>/<id:\d+>'     => 'prayer-requests/<action>',
                'prayer-requests/<action:\w+>'              => 'prayer-requests/<action>',

                // ── Children CRUD ─────────────────────────────
                'children'                              => 'children/index',
                'children/<action:\w+>/<id:\d+>'        => 'children/<action>',
                'children/<action:\w+>'                 => 'children/<action>',

                // ── Users CRUD (admin) ────────────────────────
                'users'                                 => 'users/index',
                'users/<action:\w+>/<id:\d+>'           => 'users/<action>',
                'users/<action:\w+>'                    => 'users/<action>',

                // ── Profile ───────────────────────────────────
                'profile'       => 'site/profile',
                'profile/edit'  => 'site/edit-profile',
            ],
        ],
    ],

    'params'   => $params,
    'timeZone' => 'Africa/Dar_es_Salaam',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class'      => \yii\debug\Module::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'      => \yii\gii\Module::class,
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;