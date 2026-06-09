<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\User;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\base\Security;
use yii\mail\MailerInterface;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly MailerInterface $mailer,
        private readonly Security $security,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'transparent' => true,
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionLogin(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load($this->request->post()) && $model->login()) {
    $role = Yii::$app->user->identity->role;
    if ($role === 'member') {
        return $this->redirect(['/member/dashboard']);
    }
    return $this->redirect(['/dashboard/index']);
}
        

        

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionRegister(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->username = $post['User']['username'];
            $model->email = $post['User']['email'];
            $model->role = 'member';
            $model->status = 1;
            $model->setPassword($post['User']['password_hash']);
            $model->auth_key = Yii::$app->security->generateRandomString();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Account imefanikiwa! Ingia sasa.');
                return $this->redirect(['site/login']);
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionContact(): Response|string
    {
        $model = new ContactForm();

        $contact = $model->load($this->request->post()) && $model->contact(
            $this->mailer,
            Yii::$app->params['adminEmail'],
            Yii::$app->params['senderEmail'],
            Yii::$app->params['senderName'],
        );

        if ($contact) {
            Yii::$app->session->setFlash(
                'success',
                'Thank you for contacting us. We will respond to you as soon as possible.',
            );
            return $this->refresh();
        }

        return $this->render('contact', ['model' => $model]);
    }

    public function actionAbout(): string
    {
        return $this->render('about');
    }

    public function actionOfferings(): string
    {
        return $this->render('offerings');
    }
}   
