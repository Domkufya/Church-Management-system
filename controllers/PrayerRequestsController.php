<?php

namespace app\controllers;

use Yii;
use app\models\PrayerRequests;
use app\models\PrayerRequestsSearch;
use app\models\Members;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PrayerRequestsController extends Controller
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
                            'actions' => ['index', 'view'],
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
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $member = Members::findOne(['user_id' => $user->id]);

        // Admin/pastor/secretary anaona yote
        if ($user->role !== 'member') {
            $searchModel = new PrayerRequestsSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'user' => $user,
                'member' => $member,
            ]);
        }

        // Member anaona maombi yake + maombi ya admin
        $adminPrayers = PrayerRequests::find()
            ->where(['created_by_role' => ['admin', 'pastor', 'secretary', 'superadmin', 'treasurer']])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        $myPrayers = [];
        if ($member) {
            $myPrayers = PrayerRequests::find()
                ->where(['member_id' => $member->id, 'created_by_role' => 'member'])
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        }

        return $this->render('member-index', [
            'adminPrayers' => $adminPrayers,
            'myPrayers' => $myPrayers,
            'user' => $user,
            'member' => $member,
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
        $model = new PrayerRequests();
        $user = Yii::$app->user->identity;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_by_role = $user->role;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
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

    protected function findModel($id)
    {
        if (($model = PrayerRequests::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}