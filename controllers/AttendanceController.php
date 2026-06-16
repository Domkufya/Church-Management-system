<?php

namespace app\controllers;
<<<<<<< HEAD

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
=======
use Yii;
use app\models\Attendance;
use app\models\AttendanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
{
    return array_merge(
        parent::behaviors(),
        [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->role !== 'member';
                        },
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['/member/dashboard']);
                },
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]
    );
}

    /**
     * Lists all Attendance models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

<<<<<<< HEAD
=======
    /**
     * Displays a single Attendance model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
    public function actionCreate()
    {
        $model = new Attendance();

<<<<<<< HEAD
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

=======
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Attendance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Deletes an existing Attendance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
    protected function findModel($id)
    {
        if (($model = Attendance::findOne(['id' => $id])) !== null) {
            return $model;
        }
<<<<<<< HEAD
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
=======

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionTakeAttendance($event_id = null)
{
    $events = \app\models\Events::find()->all();
    $members = \app\models\Members::find()->where(['status' => 'Active'])->all();
    
    if (Yii::$app->request->isPost) {
        $post = Yii::$app->request->post();
        $event_id = $post['event_id'];
        $attendances = $post['attendance'] ?? [];
        
        // Delete existing attendance for this event
        Attendance::deleteAll(['event_id' => $event_id]);
        
        // Save new attendance
        foreach ($members as $member) {
            $attendance = new Attendance();
            $attendance->event_id = $event_id;
            $attendance->member_id = $member->id;
            $attendance->status = isset($attendances[$member->id]) ? 'Present' : 'Absent';
            $attendance->recorded_at = date('Y-m-d H:i:s');
            $attendance->save();
        }
        
        Yii::$app->session->setFlash('success', 'Attendance saved successfully!');
        return $this->redirect(['take-attendance', 'event_id' => $event_id]);
    }
    
    return $this->render('take-attendance', [
        'events' => $events,
        'members' => $members,
        'event_id' => $event_id,
    ]);
}
}
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
