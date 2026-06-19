<?php
/**
 * SuperadminController
 * Place at: controllers/SuperadminController.php
 *
 * Only accessible by users with role = 'superadmin'
 */
declare(strict_types=1);

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Roles;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\data\ActiveDataProvider;

class SuperadminController extends Controller
{
    public $layout = 'main';

    public function behaviors(): array
{
    return [
        'access' => [
            'class'       => AccessControl::class,
            'rules'       => [
                [
                    'allow'         => true,
                    'roles'         => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return !Yii::$app->user->isGuest
                            && Yii::$app->user->identity->role === User::ROLE_SUPERADMIN;
                    },
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                if (Yii::$app->user->isGuest) {
                    return Yii::$app->response->redirect(['/site/login']);
                }
                throw new ForbiddenHttpException('Access denied. Super Administrator only.');
            },
        ],
    ];
}
    // ─────────────────────────────────────────────────────────────────
    //  Dashboard
    // ─────────────────────────────────────────────────────────────────

    public function actionDashboard(): string
    {
        $this->view->title = 'Super Admin Dashboard';

        $stats = [
            'total_users'   => User::find()->count(),
            'superadmins'   => User::find()->where(['role' => User::ROLE_SUPERADMIN])->count(),
            'admins'        => User::find()->where(['role' => User::ROLE_ADMIN])->count(),
            'pastors'       => User::find()->where(['role' => User::ROLE_PASTOR])->count(),
            'secretaries'   => User::find()->where(['role' => User::ROLE_SECRETARY])->count(),
            'treasurers'    => User::find()->where(['role' => User::ROLE_TREASURER])->count(),
            'dept_leaders'  => User::find()->where(['role' => User::ROLE_DEPARTMENT_LEADER])->count(),
            'members'       => User::find()->where(['role' => User::ROLE_MEMBER])->count(),
        ];

        $recentUsers = User::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(10)
            ->all();

        $roles = Roles::find()->where(['is_active' => 1])->orderBy(['level' => SORT_DESC])->all();

        return $this->render('dashboard', [
            'stats'       => $stats,
            'recentUsers' => $recentUsers,
            'roles'       => $roles,
        ]);
    }

    // ─────────────────────────────────────────────────────────────────
    //  Manage Users — list all with role filter
    // ─────────────────────────────────────────────────────────────────

    public function actionUsers(): string
    {
        $this->view->title = 'Manage Users';

        $roleFilter = Yii::$app->request->get('role', '');

        $query = User::find()->orderBy(['id' => SORT_DESC]);
        if ($roleFilter !== '') {
            $query->where(['role' => $roleFilter]);
        }

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => ['pageSize' => 20],
        ]);

        $roles = Roles::find()->where(['is_active' => 1])->orderBy(['level' => SORT_DESC])->all();

        return $this->render('users', [
            'dataProvider' => $dataProvider,
            'roles'        => $roles,
            'roleFilter'   => $roleFilter,
        ]);
    }

    // ─────────────────────────────────────────────────────────────────
    //  Assign / change role for a user
    // ─────────────────────────────────────────────────────────────────

    public function actionAssignRole(): Response
{
    $userId  = (int) Yii::$app->request->get('user_id');
    $newRole = (string) Yii::$app->request->get('role');

    $allowedRoles = [
        User::ROLE_ADMIN, User::ROLE_PASTOR, User::ROLE_SECRETARY,
        User::ROLE_TREASURER, User::ROLE_DEPARTMENT_LEADER, User::ROLE_MEMBER,
        User::ROLE_SUPERADMIN,
    ];

    if (!in_array($newRole, $allowedRoles, true)) {
        Yii::$app->session->setFlash('error', 'Invalid role selected.');
        return $this->redirect(['/superadmin/users']);
    }

    $user = User::findOne($userId);
    if (!$user) {
        Yii::$app->session->setFlash('error', 'User not found.');
        return $this->redirect(['/superadmin/users']);
    }

    if ($user->id === Yii::$app->user->id && $newRole !== User::ROLE_SUPERADMIN) {
        Yii::$app->session->setFlash('error', 'You cannot change your own superadmin role.');
        return $this->redirect(['/superadmin/users']);
    }

    $roleModel     = Roles::findOne(['name' => $newRole]);
    $user->role    = $newRole;
    $user->role_id = $roleModel ? $roleModel->id : null;

    if ($user->save(false)) {
        Yii::$app->session->setFlash('success', "Role updated: {$user->username} is now " . $user->getRoleLabel() . '.');
    } else {
        Yii::$app->session->setFlash('error', 'Failed to update role.');
    }

    return $this->redirect(['/superadmin/users']);
}
    // ─────────────────────────────────────────────────────────────────
    //  Toggle user active / inactive
    // ─────────────────────────────────────────────────────────────────

    public function actionToggleStatus(int $id): Response
    {
        $user = User::findOne($id);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'User not found.');
            return $this->redirect(['/superadmin/users']);
        }

        if ($user->id === Yii::$app->user->id) {
            Yii::$app->session->setFlash('error', 'You cannot deactivate your own account.');
            return $this->redirect(['/superadmin/users']);
        }

        $user->status = $user->status === User::STATUS_ACTIVE
            ? User::STATUS_INACTIVE
            : User::STATUS_ACTIVE;

        $user->save(false);

        $state = $user->status === User::STATUS_ACTIVE ? 'activated' : 'deactivated';
        Yii::$app->session->setFlash('success', "User {$user->username} has been {$state}.");

        return $this->redirect(['/superadmin/users']);
    }

    // ─────────────────────────────────────────────────────────────────
    //  Delete user (hard delete — use with caution)
    // ─────────────────────────────────────────────────────────────────

    public function actionDeleteUser(): Response
{
    $userId = (int) Yii::$app->request->get('user_id');
    $user   = User::findOne($userId);

    if (!$user) {
        Yii::$app->session->setFlash('error', 'User not found.');
        return $this->redirect(['/superadmin/users']);
    }

    if ($user->id === Yii::$app->user->id) {
        Yii::$app->session->setFlash('error', 'You cannot delete your own account.');
        return $this->redirect(['/superadmin/users']);
    }

    if ($user->role === User::ROLE_SUPERADMIN) {
        Yii::$app->session->setFlash('error', 'Cannot delete another superadmin account.');
        return $this->redirect(['/superadmin/users']);
    }

    $username = $user->username;
    $user->delete();

    Yii::$app->session->setFlash('success', "User \"{$username}\" has been deleted.");
    return $this->redirect(['/superadmin/users']);

}
}