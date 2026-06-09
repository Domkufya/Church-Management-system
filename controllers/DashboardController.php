<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Members;
use app\models\Departments;
use app\models\Events;
use app\models\Offerings;
use app\models\Expenses;
use app\models\PrayerRequests;
use app\models\Children;
use app\models\Attendance;

class DashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $stats = [
            'members'        => Members::find()->count(),
            'departments'    => Departments::find()->count(),
            'offerings'      => Offerings::find()->sum('amount') ?? 0,
            'expenses'       => Expenses::find()->sum('amount') ?? 0,
            'prayer_requests'=> PrayerRequests::find()->count(),
            'children'       => Children::find()->count(),
            'attendance'     => Attendance::find()->count(),
            'events'         => Events::find()->count(),
        ];

        $recent_events = Events::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->all();

        $recent_members = Members::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->all();

        return $this->render('index', [
            'stats'          => $stats,
            'recent_events'  => $recent_events,
            'recent_members' => $recent_members,
        ]);
    }
}