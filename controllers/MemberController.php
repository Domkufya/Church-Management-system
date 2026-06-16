<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Events;
use app\models\PrayerRequests;
use app\models\Members;

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

        if ($user->role !== 'member') {
            return $this->redirect(['/dashboard/index']);
        }

        $member = Members::findOne(['user_id' => $user->id]);

        $prayers = [];
        if ($member) {
            $prayers = PrayerRequests::find()
                ->where(['member_id' => $member->id])
                ->orderBy(['id' => SORT_DESC])
                ->limit(5)
                ->all();
        }

        $events = Events::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->all();

        return $this->render('dashboard', [
            'events' => $events,
            'prayers' => $prayers,
            'user' => $user,
        ]);
    }

    public function actionPrayers()
    {
        $user = Yii::$app->user->identity;
        $member = Members::findOne(['user_id' => $user->id]);

        $prayers = [];
        if ($member) {
            $prayers = PrayerRequests::find()
                ->where(['member_id' => $member->id])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }

        return $this->render('prayers', [
            'prayers' => $prayers,
            'user' => $user,
        ]);
    }

    public function actionCreatePrayer()
    {
        $user = Yii::$app->user->identity;
        $member = Members::findOne(['user_id' => $user->id]);

        if (!$member) {
            Yii::$app->session->setFlash('error', 'Your account is not linked to a member record. Please contact admin.');
            return $this->redirect(['member/dashboard']);
        }

        $model = new PrayerRequests();
        $model->member_id = $member->id;
        $model->status = 'Pending';

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->member_id = $member->id;
            $model->status = 'Pending';
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Prayer request submitted successfully!');
                return $this->redirect(['member/prayers']);
            }
        }

        return $this->render('create-prayer', [
            'model' => $model,
            'user' => $user,
        ]);
    }
}