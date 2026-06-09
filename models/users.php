<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string|null $role
 * @property int|null $status
 * @property string|null $created_at
 *
 * @property Expenses[] $expenses
 * @property Offerings[] $offerings
 */
class users extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_PASTOR = 'pastor';
    const ROLE_SECRETARY = 'secretary';
    const ROLE_TREASURER = 'treasurer';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'default', 'value' => 'secretary'],
            [['status'], 'default', 'value' => 1],
            [['username', 'password_hash', 'email'], 'required'],
            [['role'], 'string'],
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            ['role', 'in', 'range' => array_keys(self::optsRole())],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Expenses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpenses()
    {
        return $this->hasMany(Expenses::class, ['approved_by' => 'id']);
    }

    /**
     * Gets query for [[Offerings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfferings()
    {
        return $this->hasMany(Offerings::class, ['received_by' => 'id']);
    }


    /**
     * column role ENUM value labels
     * @return string[]
     */
    public static function optsRole()
    {
        return [
            self::ROLE_ADMIN => 'admin',
            self::ROLE_PASTOR => 'pastor',
            self::ROLE_SECRETARY => 'secretary',
            self::ROLE_TREASURER => 'treasurer',
        ];
    }

    /**
     * @return string
     */
    public function displayRole()
    {
        return self::optsRole()[$this->role];
    }

    /**
     * @return bool
     */
    public function isRoleAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setRoleToAdmin()
    {
        $this->role = self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isRolePastor()
    {
        return $this->role === self::ROLE_PASTOR;
    }

    public function setRoleToPastor()
    {
        $this->role = self::ROLE_PASTOR;
    }

    /**
     * @return bool
     */
    public function isRoleSecretary()
    {
        return $this->role === self::ROLE_SECRETARY;
    }

    public function setRoleToSecretary()
    {
        $this->role = self::ROLE_SECRETARY;
    }

    /**
     * @return bool
     */
    public function isRoleTreasurer()
    {
        return $this->role === self::ROLE_TREASURER;
    }

    public function setRoleToTreasurer()
    {
        $this->role = self::ROLE_TREASURER;
    }
}
