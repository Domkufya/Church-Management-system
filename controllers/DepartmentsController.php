<?php

namespace app\controllers;

use Yii;
use app\models\Departments;
use app\models\DepartmentsSearch;
use app\models\MemberDepartments;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DepartmentsController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'join', 'requests', 'approve', 'reject'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                        [
                            'actions' => ['create', 'update', 'delete'],
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
                        'join' => ['POST'],
                        'approve' => ['POST'],
                        'reject' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new DepartmentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

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
        $model = new Departments();

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

    public function actionJoin($id)
    {
        $member = \app\models\Members::findOne(['user_id' => Yii::$app->user->id]);

        if (!$member) {
            Yii::$app->session->setFlash('error', 'Member profile not found!');
            return $this->redirect(['index']);
        }

        $anyDept = MemberDepartments::findOne(['member_id' => $member->id]);

        if ($anyDept) {
            Yii::$app->session->setFlash('error', 'You can only join one department! You are already in ' . $anyDept->department->name . '.');
            return $this->redirect(['index']);
        }

        $join = new MemberDepartments();
        $join->member_id = $member->id;
        $join->department_id = $id;
        $join->status = 'Pending';

        if ($join->save()) {
            Yii::$app->session->setFlash('success', 'Request sent! Waiting for admin approval.');
        }

        return $this->redirect(['index']);
    }

    public function actionRequests()
    {
        $requests = MemberDepartments::find()
            ->where(['status' => 'Pending'])
            ->all();

        return $this->render('requests', [
            'requests' => $requests,
        ]);
    }

    public function actionApprove($id)
    {
        $request = MemberDepartments::findOne($id);
        if ($request) {
            $request->status = 'Approved';
            $request->save();
            Yii::$app->session->setFlash('success', 'Request approved!');
        }
        return $this->redirect(['requests']);
    }

    public function actionReject($id)
    {
        $request = MemberDepartments::findOne($id);
        if ($request) {
            $request->status = 'Rejected';
            $request->save();
            Yii::$app->session->setFlash('success', 'Request rejected!');
        }
        return $this->redirect(['requests']);
    }

    protected function findModel($id)
    {
        if (($model = Departments::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}