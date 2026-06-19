<?php
/**
 * User model
 * Place at: models/User.php
 *
 * Synced with users table columns:
 *   id, username, password_hash, auth_key, email,
 *   role (ENUM), role_id (FK), status, created_at
 */
declare(strict_types=1);

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int    $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property string $email
 * @property string $role
 * @property int    $role_id
 * @property int    $status
 * @property int    $created_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    // ── All system roles — keep in sync with roles table and users.role ENUM ──
    public const ROLE_SUPERADMIN        = 'superadmin';
    public const ROLE_ADMIN             = 'admin';
    public const ROLE_PASTOR            = 'pastor';
    public const ROLE_SECRETARY         = 'secretary';
    public const ROLE_TREASURER         = 'treasurer';
    public const ROLE_DEPARTMENT_LEADER = 'department_leader';
    public const ROLE_MEMBER            = 'member';

    // ── Roles that can access the admin/staff dashboard ──
    public const STAFF_ROLES = [
        self::ROLE_SUPERADMIN,
        self::ROLE_ADMIN,
        self::ROLE_PASTOR,
        self::ROLE_SECRETARY,
        self::ROLE_TREASURER,
        self::ROLE_DEPARTMENT_LEADER,
    ];

    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE   = 1;

    public static function tableName(): string
    {
        return 'users';
    }

    public function rules(): array
    {
        return [
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'max' => 50],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            ['email', 'string', 'max' => 100],

            ['password_hash', 'required'],
            ['password_hash', 'string', 'min' => 6],

            ['role', 'in', 'range' => [
                self::ROLE_SUPERADMIN,
                self::ROLE_ADMIN,
                self::ROLE_PASTOR,
                self::ROLE_SECRETARY,
                self::ROLE_TREASURER,
                self::ROLE_DEPARTMENT_LEADER,
                self::ROLE_MEMBER,
            ]],

            ['role_id', 'integer'],
            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'            => 'ID',
            'username'      => 'Username',
            'email'         => 'Email',
            'password_hash' => 'Password',
            'role'          => 'Role',
            'status'        => 'Status',
            'created_at'    => 'Created At',
        ];
    }

    // ── IdentityInterface ──────────────────────────────────────────

    public static function findIdentity($id): ?static
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?static
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername(string $username): ?static
    {
        return static::findOne([
            'username' => $username,
            'status'   => self::STATUS_ACTIVE,
        ]);
    }

    public static function findByEmail(string $email): ?static
    {
        return static::findOne([
            'email'  => $email,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function getId(): int
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    // ── Password ───────────────────────────────────────────────────

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey(): void
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    // ── Role helpers ───────────────────────────────────────────────

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isMember(): bool
    {
        return $this->role === self::ROLE_MEMBER;
    }

    public function isStaff(): bool
    {
        return in_array($this->role, self::STAFF_ROLES, true);
    }

    /** Human-readable role label */
    public function getRoleLabel(): string
    {
        return match($this->role) {
            self::ROLE_SUPERADMIN        => 'Super Administrator',
            self::ROLE_ADMIN             => 'Administrator',
            self::ROLE_PASTOR            => 'Pastor',
            self::ROLE_SECRETARY         => 'Secretary',
            self::ROLE_TREASURER         => 'Treasurer',
            self::ROLE_DEPARTMENT_LEADER => 'Department Leader',
            self::ROLE_MEMBER            => 'Church Member',
            default                      => ucfirst($this->role),
        };
    }

    // ── Relation ───────────────────────────────────────────────────

    public function getRoleModel(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Roles::class, ['id' => 'role_id']);
    }
}