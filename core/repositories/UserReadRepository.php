<?php

namespace core\repositories;

use core\entities\User;

/**
 * Class UserReadRepository
 * @package core\repositories
 */
class UserReadRepository
{
    /**
     * @param $id
     * @return User|null
     */
    public function find($id): ?User
    {
        return User::findOne($id);
    }

    /**
     * @param $username
     * @return User|null
     */
    public function findActiveByUsername($username): ?User
    {
        return User::findOne(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    /**
     * @param $id
     * @return User|null
     */
    public function findActiveById($id): ?User
    {
        return User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }
}