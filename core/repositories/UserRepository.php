<?php

namespace core\repositories;

use core\entities\User;
use RuntimeException;
use Throwable;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;

/**
 * Class UserRepository
 * @package core\repositories
 */
class UserRepository
{
    /**
     * @param $value
     * @return User| ActiveRecord | null
     */
    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    /**
     * @param $id
     * @return User
     */
    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }

    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param User $user
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }

    /**
     * @param array $condition
     * @return User | ActiveRecord
     */
    private function getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }
}