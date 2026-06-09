<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Events;
use app\models\PrayerRequests;


class MemberController extends Controller
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

    public function actionDashboard()
    {
        $user = Yii::$app->user->identity;

        // Redirect admin kwenda dashboard yao
        if ($user->role !== 'member') {
            return $this->redirect(['/dashboard/index']);
        }

        $events = Events::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->all();

        $prayers = PrayerRequests::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->all();

        return $this->render('dashboard', [
            'events' => $events,
            'prayers' => $prayers,
            'user' => $user,
        ]);
    }
}