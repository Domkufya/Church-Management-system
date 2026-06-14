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
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        // Member is allowed to register only
                        ['actions' => ['create'], 'allow' => true, 'roles' => ['@']], 
                        
                        // Admin is the only one allowed to perform other actions
                        [
                            'actions' => ['index', 'update-status', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return Yii::$app->user->identity->role !== 'member';
                            },
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
            ]
        );
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

    public function actionCreate()
    {
        $model = new Attendance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Alert that the submission is successfully
            Yii::$app->session->setFlash('success', 'Hongera! Mahudhurio yako yamesajiliwa kikamilifu.');
            return $this->redirect(['create']);
        }

        $memberList = ArrayHelper::map(Members::find()->all(), 'id', function($member) {
            return $member->first_name . ' ' . $member->last_name;
        });

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
            Yii::$app->session->setFlash('success', 'Attendance status updated to ' . $status);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to update status.');
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Attendance::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}