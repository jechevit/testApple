<?php

namespace common\auth;

use core\entities\User;
use core\repositories\UserReadRepository;
use OAuth2\Storage\UserCredentialsInterface;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\di\NotInstantiableException;
use yii\web\IdentityInterface;

/**
 * @property string username
 */
class Identity implements IdentityInterface, UserCredentialsInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->username = $this->user->username;
    }

    /**
     * @param int|string $id
     * @return Identity|IdentityInterface|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user): null;
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return Identity|IdentityInterface|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $data = self::getOauth()->getServer()->getResourceController()->getToken();
        return !empty($data['user_id']) ? static::findIdentity($data['user_id']) : null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->user->id;
    }

    /**
     * @return string
     */
    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function checkUserCredentials($username, $password): bool
    {
        if (!$user = self::getRepository()->findActiveByUsername($username)) {
            return false;
        }
        return $user->validatePassword($password);
    }

    /**
     * @param string $username
     * @return array
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function getUserDetails($username): array
    {
        $user = self::getRepository()->findActiveByUsername($username);
        return ['user_id' => $user->id];
    }

    /**
     * @return UserReadRepository
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    private static function getRepository(): UserReadRepository
    {
        return Yii::$container->get(UserReadRepository::class);
    }

    /**
     * @return Module
     */
    private static function getOauth(): Module
    {
        return Yii::$app->getModule('oauth2');
    }
}