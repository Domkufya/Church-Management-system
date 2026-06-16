<?php

namespace app\controllers;
<<<<<<< HEAD

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

=======
use Yii;
use app\models\Departments;
use app\models\DepartmentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentsController implements the CRUD actions for Departments model.
 */
class DepartmentsController extends Controller
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
     * Lists all Departments models.
     *
     * @return string
     */
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
    public function actionIndex()
    {
        $searchModel = new DepartmentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

<<<<<<< HEAD
=======
    /**
     * Displays a single Departments model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

<<<<<<< HEAD
=======
    /**
     * Creates a new Departments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
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

<<<<<<< HEAD
=======
    /**
     * Updates an existing Departments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
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

<<<<<<< HEAD
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
=======
    /**
     * Deletes an existing Departments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e

        return $this->redirect(['index']);
    }

<<<<<<< HEAD
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

=======
    /**
     * Finds the Departments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Departments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
    protected function findModel($id)
    {
        if (($model = Departments::findOne(['id' => $id])) !== null) {
            return $model;
        }
<<<<<<< HEAD
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
=======

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
