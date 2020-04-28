<?php

namespace core\entities;

use core\database\Table;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class User
 * @property int $id
 * @property string username
 * @property string email
 * @property string phone
 * @property int created_at
 * @property string $password_reset_token
 * @property string $password_hash
 * @property int updated_at
 * @property int status
 * @property string auth_key
 * @package core\entities\User
 */
class User extends ActiveRecord
{
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @param string $username
     * @param string $email
     * @param string $phone
     * @param string $password
     * @return User
     * @throws Exception
     */
    public static function create(string $username, string $email, string $phone, string $password): self
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->phone = $phone;
        $user->setPassword(!empty($password) ? $password : Yii::$app->security->generateRandomString());
        $user->created_at = time();
        $user->status = self::STATUS_ACTIVE;
        $user->auth_key = Yii::$app->security->generateRandomString();

        return $user;
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $phone
     */
    public function edit(string $username, string $email, string $phone): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->updated_at = time();
    }

    /**
     * @return bool
     */
    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Table::USERS;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws Exception
     */

    private function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}