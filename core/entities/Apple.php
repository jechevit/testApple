<?php

namespace core\entities;

use core\database\Table;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $color
 * @property int $eaten
 * @property int $status
 * @property int $fallen_at
 * @property int $created_at
 */
class Apple extends ActiveRecord
{
    const COLOR_RED = 100;
    const COLOR_GREEN = 110;
    const COLOR_YELLOW = 120;

    const STATUS_ON_TREE = 0;
    const STATUS_IS_FALLEN = 1;
    const STATUS_ROTTEN = 2;

    /**
     * @param $color
     * @return static
     */
    public static function create(
        $color
    ): self
    {
        $apple = new static();
        $apple->color = $color;
        $apple->eaten = 100;
        $apple->status = self::STATUS_ON_TREE;
        $apple->created_at = time();
        return $apple;
    }

    /**
     * @return void
     */
    public function fall(): void
    {
        if ($this->isFall()){
            throw new \DomainException('apple has already fallen');
        }
        $this->fallen_at = time();
        $this->status = self::STATUS_IS_FALLEN;
    }

    /**
     * @return bool
     */
    public function isFall(): bool
    {
        return $this->status == self::STATUS_IS_FALLEN;
    }

    /**
     * @return bool
     */
    public function isOnTree(): bool
    {
        return $this->status == self::STATUS_ON_TREE;
    }

    /**
     * @return int
     */
    public function rot(): int
    {
        if ($this->isRotten()){
            throw new \DomainException('apple has already rotten');
        }
        return $this->status = self::STATUS_ROTTEN;
    }

    /**
     * @return bool
     */
    public function isRotten(): bool
    {
        return $this->status == self::STATUS_ROTTEN;
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return Table::APPLES;
    }
}