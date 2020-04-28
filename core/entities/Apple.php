<?php

namespace core\entities;

use core\database\Table;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $color
 * @property int $eaten
 * @property int $is_rotten
 * @property int $status
 * @property int $fallen_at
 * @property int $created_at
 */
class Apple extends ActiveRecord
{
    const COLOR_RED = 100;
    const COLOR_GREEN = 110;
    const COLOR_YELLOW = 120;

    const ON_TREE = 0;
    const IS_FALLEN = 1;

    const ROTTEN = 1;
    const NOT_ROTTEN = 0;

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
        $apple->status = self::ON_TREE;
        $apple->is_rotten = self::NOT_ROTTEN;
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
        $this->status = self::IS_FALLEN;
    }

    /**
     * @return bool
     */
    public function isFall(): bool
    {
        return $this->eaten == self::IS_FALLEN;
    }

    /**
     * @return bool
     */
    public function isOnTree(): bool
    {
        return $this->status == self::ON_TREE;
    }

    /**
     * @return int
     */
    public function rot(): int
    {
        if ($this->isRotten()){
            throw new \DomainException('apple has already rotten');
        }
        return $this->is_rotten = self::ROTTEN;
    }

    /**
     * @return bool
     */
    public function isRotten(): bool
    {
        return $this->is_rotten == self::ROTTEN;
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return Table::APPLES;
    }
}