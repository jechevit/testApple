<?php

namespace core\services;

use core\entities\User;
use core\forms\LoginForm;
use core\repositories\UserRepository;

/**
 * Class AuthService
 * @package core\services
 */
class AuthService
{
    /**
     * @var UserRepository
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param LoginForm $form
     * @return User
     */
    public function auth(LoginForm $form): User
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive()  || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password.');
        }
        return $user;
    }
}