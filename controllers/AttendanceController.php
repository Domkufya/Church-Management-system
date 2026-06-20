<?php

namespace app\controllers;

use Yii;
use app\models\Attendance;
use app\models\AttendanceSearch;
use app\models\Members;
use app\models\Events;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class AttendanceController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'update-status' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Attendance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Attendance saved successfully!');
            return $this->redirect(['create']);
        }

        $memberList = ArrayHelper::map(
            Members::find()->all(),
            'id',
            fn($m) => $m->first_name . ' ' . $m->last_name
        );

        return $this->render('create', [
            'model' => $model,
            'memberList' => $memberList,
        ]);
    }

    public function actionUpdateStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Status updated');
        }

        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionTakeAttendance($event_id = null)
    {
        $events = Events::find()->all();
        $members = Members::find()->all();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $event_id = $post['event_id'];
            $attendances = $post['attendance'] ?? [];

            Attendance::deleteAll(['event_id' => $event_id]);

            foreach ($members as $member) {
    $attendance = new Attendance();
    $attendance->event_id = (int)$event_id;
    $attendance->member_id = (int)$member->id;
    $attendance->status = isset($attendances[$member->id]) ? 'Present' : 'Absent';
    
    if (!$attendance->save()) {
        Yii::error($attendance->errors);
    }
}
            Yii::$app->session->setFlash('success', 'Attendance saved!');
            return $this->redirect(['take-attendance', 'event_id' => $event_id]);
        }

        return $this->render('take-attendance', [
            'events' => $events,
            'members' => $members,
            'event_id' => $event_id,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Attendance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}