<?php

namespace console\controllers;

use Yii;
use yii\base\Exception;
use yii\console\Controller;

class RoleController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionRole()
    {
        $auth = Yii::$app->authManager;

        $access = $auth->createPermission('accessPanel');
        $access->description = 'Доступ в админку';
        $auth->add($access);

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $auth->add($admin);

        $auth->addChild($admin, $access);
    }
}