<?php

namespace core\repositories;

use core\entities\Apple;
use Throwable;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;

class AppleRepository
{
    /**
     * @param $id
     * @return Apple | ActiveRecord
     */
    public function get($id): Apple
    {
        if (!$apple = Apple::findone(['id' => $id])) {
            throw new NotFoundException('Apple is not found.');
        }
        return $apple;
    }

    /**
     * @param Apple $category
     */
    public function save(Apple $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Apple $category
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function remove(Apple $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}