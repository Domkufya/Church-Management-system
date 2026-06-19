<?php
/**
 * LoginForm model
 * Place at: models/LoginForm.php
 *
 * Supports login by username OR email
 */
declare(strict_types=1);

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public string $username  = '';
    public string $password  = '';
    public bool   $rememberMe = true;

    private ?User $_user = null;

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'username'   => 'Username / Email',
            'password'   => 'Password',
            'rememberMe' => 'Keep me signed in',
        ];
    }

    /**
     * Validates the password.
     * Runs after user is found by username or email.
     */
    public function validatePassword(string $attribute, $params): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if ($user === null || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username/email or password.');
            }
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0;
            return Yii::$app->user->login($this->getUser(), $duration);
        }
        return false;
    }

    /**
     * Find user by username OR email
     */
    public function getUser(): ?User
    {
        if ($this->_user === null) {
            // Try username first, then email
            $this->_user = User::findByUsername($this->username)
                        ?? User::findByEmail($this->username);
        }
        return $this->_user;
    }
}