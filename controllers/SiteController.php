<?php
/**
 * SiteController
 * Place at: controllers/SiteController.php
 */
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
    /**
     * Layout used for authenticated pages.
     * Guest (auth) pages override this with 'auth'.
     */
    public $layout = 'main';

    public function __construct(
        $id,
        $module,
        private readonly MailerInterface $mailer,
        private readonly Security $security,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * Centralized role → dashboard URL resolver.
     * Added 'superadmin' here — everything else unchanged.
     */
    private function dashboardUrlForRole(string $role): array
    {
        return match ($role) {
            'superadmin' => ['/superadmin/dashboard'],
            'member'     => ['/member/dashboard'],
            default      => ['/dashboard/index'],
        };
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['logout', 'profile', 'edit-profile', 'complete-profile'],
                'rules' => [
                    [
                        'actions' => ['logout', 'profile', 'edit-profile', 'complete-profile'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class'   => VerbFilter::class,
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
                'class'           => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'transparent'     => true,
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────────
    //  Landing / Home
    // ─────────────────────────────────────────────────────────────────

    public function actionIndex(): Response|string
    {
        // Landing page uses main layout — guest sees the two-panel page,
        // authenticated users are redirected to their dashboard.
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
            return $this->redirect($this->dashboardUrlForRole($role));
        }
        return $this->render('index');
    }

    // ─────────────────────────────────────────────────────────────────
    //  Sign In
    // ─────────────────────────────────────────────────────────────────

    public function actionLogin(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
            return $this->redirect($this->dashboardUrlForRole($role));
        }

        $this->layout = 'auth';  // ← full-screen auth layout

        $model = new LoginForm();

        if ($model->load($this->request->post()) && $model->login()) {
            $role = Yii::$app->user->identity->role;
            return $this->redirect($this->dashboardUrlForRole($role));
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    // ─────────────────────────────────────────────────────────────────
    //  Create Account  (Step 1)
    // ─────────────────────────────────────────────────────────────────

    public function actionRegister(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'auth';  // ← full-screen auth layout

        $model = new User();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            $model->username = $post['User']['username'];
            $model->email    = $post['User']['email'];
            $model->role     = 'member';   // public registration always creates a member
            $model->status   = 1;
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->setPassword($post['User']['password_hash']);

            if ($model->save()) {
                Yii::$app->user->login($model, 0);
                Yii::$app->session->setFlash('success', 'Account created! Please complete your profile.');
                return $this->redirect(['/site/complete-profile']);
            }

            // Show validation errors
            Yii::$app->session->setFlash('error', implode(' ', array_merge(...array_values($model->getErrors()))));
        }

        return $this->render('register', ['model' => $model]);
    }

    // ─────────────────────────────────────────────────────────────────
    //  Complete Profile  (Step 2 — after registration)
    // ─────────────────────────────────────────────────────────────────

    public function actionCompleteProfile(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $this->layout = 'auth';  // still full-screen — user hasn't entered app yet

        $model = new Members();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // Age check — must be 18+
            if (!empty($model->dob)) {
                $dob = new \DateTime($model->dob);
                $age = (new \DateTime())->diff($dob)->y;

                if ($age < 18) {
                    Yii::$app->session->setFlash('error', 'You must be at least 18 years old to register.');
                    return $this->render('complete-profile', ['model' => $model]);
                }
            }

            $model->user_id         = Yii::$app->user->id;
            $model->status          = 'Active';
            $model->membership_date = date('Y-m-d');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Welcome to the church family! 🎉');
                return $this->redirect(['/member/dashboard']);
            }

            Yii::$app->session->setFlash('error', implode(' ', array_merge(...array_values($model->getErrors()))));
        }

        return $this->render('complete-profile', ['model' => $model]);
    }

    // ─────────────────────────────────────────────────────────────────
    //  Forgot Password
    //
    //  Generates a human-readable token (e.g. A3F9-KQ2M-X7PB-LN4R),
    //  saves it as the user's password hash so they can log in with it,
    //  and displays it on-screen for the user to copy.
    // ─────────────────────────────────────────────────────────────────

    public function actionForgotPassword(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'auth';

        $token     = null;
        $tokenUser = null;

        if (Yii::$app->request->isPost) {
            $email = trim((string) Yii::$app->request->post('email', ''));

            /** @var User|null $user */
            $user = User::findOne(['email' => $email]);

            if ($user === null) {
                Yii::$app->session->setFlash('error', 'No account found with that email address.');
            } else {
                // Build a readable token: 4 groups of 4 uppercase chars
                $seg = fn() => strtoupper(substr(Yii::$app->security->generateRandomString(6), 0, 4));
                $rawToken = $seg() . '-' . $seg() . '-' . $seg() . '-' . $seg();

                // Set the token as the user's current password so they can log in with it
                $user->setPassword($rawToken);

                // Store the raw token if the column exists (optional tracking)
                if (property_exists($user, 'password_reset_token')) {
                    $user->password_reset_token = $rawToken . '_' . time();
                }

                $user->save(false);

                $token     = $rawToken;
                $tokenUser = $user->username;
            }
        }

        return $this->render('forgot-password', [
            'token'     => $token,
            'tokenUser' => $tokenUser,
        ]);
    }

    // ─────────────────────────────────────────────────────────────────
    //  Contact
    // ─────────────────────────────────────────────────────────────────

    public function actionContact(): Response|string
    {
        $model = new ContactForm();

        $sent = $model->load($this->request->post()) && $model->contact(
            $this->mailer,
            Yii::$app->params['adminEmail'],
            Yii::$app->params['senderEmail'],
            Yii::$app->params['senderName'],
        );

        if ($sent) {
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond as soon as possible.');
            return $this->refresh();
        }

        return $this->render('contact', ['model' => $model]);
    }

    // ─────────────────────────────────────────────────────────────────
    //  Misc
    // ─────────────────────────────────────────────────────────────────

    public function actionAbout(): string
    {
        return $this->render('about');
    }

    public function actionOfferings(): string
    {
        return $this->render('offerings');
    }
    public function actionResetSuperadmin()
{
    $hash = Yii::$app->security->generatePasswordHash('SuperAdmin@2026');
    Yii::$app->db->createCommand("UPDATE users SET password_hash = :h WHERE username = 'superadmin'")
        ->bindValue(':h', $hash)
        ->execute();
    echo "Done! Hash: " . $hash;
    Yii::$app->end();
}

    // ─────────────────────────────────────────────────────────────────
    //  Profile
    // ─────────────────────────────────────────────────────────────────

    public function actionProfile(): string
    {
        $user = Yii::$app->user->identity;
        return $this->render('profile', ['user' => $user]);
    }

    public function actionEditProfile(): Response|string
    {
        $user  = Yii::$app->user->identity;
        $model = Members::findOne(['user_id' => $user->id]);

        if (!$model) {
            return $this->redirect(['/site/complete-profile']);
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->load($post);

            // Age check
            if (!empty($model->dob)) {
                $dob = new \DateTime($model->dob);
                $age = (new \DateTime())->diff($dob)->y;

                if ($age < 18) {
                    Yii::$app->session->setFlash('error', 'You must be at least 18 years old.');
                    return $this->render('edit-profile', ['model' => $model]);
                }
            }

            // Allow user to update their password from the profile page
            $newPassword = trim((string) ($post['new_password'] ?? ''));
            if ($newPassword !== '') {
                if (strlen($newPassword) < 8) {
                    Yii::$app->session->setFlash('error', 'New password must be at least 8 characters.');
                    return $this->render('edit-profile', ['model' => $model]);
                }
                $user->setPassword($newPassword);
                // Clear the reset token once the user sets their own password
                if (property_exists($user, 'password_reset_token')) {
                    $user->password_reset_token = null;
                }
                $user->save(false);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Profile updated successfully!');
                return $this->redirect(['/site/profile']);
            }

            Yii::$app->session->setFlash('error', implode(' ', array_merge(...array_values($model->getErrors()))));
        }

        return $this->render('edit-profile', ['model' => $model]);
    }
}