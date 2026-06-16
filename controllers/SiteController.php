<?php

declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\User;
use app\models\Members;
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
                'only' => ['logout', 'profile'],
                'rules' => [
                    [
                        'actions' => ['logout', 'profile'],
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
            $model->role = $post['User']['role'] ?? 'member';
            $model->status = 1;
            $model->setPassword($post['User']['password_hash']);
            $model->auth_key = Yii::$app->security->generateRandomString();

            if ($model->save()) {
                $member = new Members();
                $member->user_id = $model->id;
                $member->first_name = $model->username;
                $member->last_name = '';
                $member->gender = 'Male';
                $member->phone = '';
                $member->email = $model->email;
                $member->address = '';
                $member->marital_status = 'Single';
                $member->save(false);

                Yii::$app->session->setFlash('success', 'Account created successfully! Please login.');
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

    public function actionProfile()
    {
        $user = Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }

        $member = Members::findOne(['user_id' => $user->id]);
        if (!$member) {
            $member = new Members();
            $member->user_id = $user->id;
            $member->first_name = $user->username;
            $member->last_name = '';
            $member->gender = 'Male';
            $member->email = $user->email;
            $member->save(false);
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            
            if (isset($post['User'])) {
                $user->username = $post['User']['username'] ?? $user->username;
                $user->email = $post['User']['email'] ?? $user->email;
                if (!empty($post['User']['password_new'])) {
                    $user->setPassword($post['User']['password_new']);
                }
                $user->save();
            }

            // Temporarily store the current photo attribute value
            $currentPhoto = $member->photo;

            if ($member->load($this->request->post())) {
                $capturedPhoto = Yii::$app->request->post('captured_photo');
                if ($capturedPhoto && strpos($capturedPhoto, 'data:image') === 0) {
                    $data = explode(',', $capturedPhoto);
                    if (count($data) === 2) {
                        $decodedImage = base64_decode($data[1]);
                        $fileName = 'member_cam_' . time() . '.jpg';
                        $uploadPath = Yii::getAlias('@webroot') . '/uploads/' . $fileName;
                        
                        if (!is_dir(dirname($uploadPath))) {
                            mkdir(dirname($uploadPath), 0777, true);
                        }
                        
                        if (file_put_contents($uploadPath, $decodedImage)) {
                            if ($currentPhoto) {
                                $oldPath = Yii::getAlias('@webroot') . '/uploads/' . $currentPhoto;
                                if (file_exists($oldPath)) {
                                    @unlink($oldPath);
                                }
                            }
                            $member->photo = $fileName;
                        }
                    }
                } else {
                    $file = \yii\web\UploadedFile::getInstance($member, 'photo');
                    if ($file) {
                        $fileName = 'member_' . time() . '.' . $file->extension;
                        $uploadPath = Yii::getAlias('@webroot') . '/uploads/' . $fileName;
                        
                        if (!is_dir(dirname($uploadPath))) {
                            mkdir(dirname($uploadPath), 0777, true);
                        }
                        
                        if ($file->saveAs($uploadPath)) {
                            if ($currentPhoto) {
                                $oldPath = Yii::getAlias('@webroot') . '/uploads/' . $currentPhoto;
                                if (file_exists($oldPath)) {
                                    @unlink($oldPath);
                                }
                            }
                            $member->photo = $fileName;
                        }
                    } else {
                        // Restore photo attribute value if no new photo uploaded/captured
                        $member->photo = $currentPhoto;
                    }
                }

                if ($member->save(false)) {
                    Yii::$app->session->setFlash('success', 'Profile updated successfully!');
                    return $this->refresh();
                }
            }
        }

        return $this->render('profile', [
            'user' => $user,
            'member' => $member,
        ]);
    }
}