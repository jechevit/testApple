<?php

namespace core\entities;

use core\database\Table;
use core\helpers\AppleHelper;
use DateTimeImmutable;
use DomainException;
use Exception;
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
    const WHOLE_APPLE= 100;

    const COLOR_RED = 100;
    const COLOR_GREEN = 110;
    const COLOR_YELLOW = 120;

    const STATUS_ON_TREE = 0;
    const STATUS_IS_FALLEN = 1;
    const STATUS_ROTTEN = 2;
    const STATUS_EATEN = 3;

    const HOURS_TO_ROT = 5;

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
        $apple->eaten = self::WHOLE_APPLE;
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
            throw new DomainException('Яблоко уже упало');
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
     * @return void
     * @throws Exception
     */
    public function rot(): void
    {
        if ($this->isRotten()){
            throw new DomainException('Яблоко уже испортилось');
        }

        if (!$this->canToRot()){
            throw new DomainException('Яблоко еще не может испортиться');
        }
        $this->status = self::STATUS_ROTTEN;
    }

    /**
     * @return bool
     * @throws Exception
     */
    private function canToRot(): bool
    {
        $timeFallen = (new DateTimeImmutable())->setTimestamp($this->fallen_at);
        $now = new DateTimeImmutable('now');

        $interval = $now->diff($timeFallen);

        if ($interval->h >= self::HOURS_TO_ROT){
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isRotten(): bool
    {
        return $this->status == self::STATUS_ROTTEN;
    }

    /**
     * @param int $piece
     */
    public function eat(int $piece): void
    {
        $balance = $this->eaten - $piece;
        $this->eaten = $balance;

        if ($balance == 0) {
            $this->status = self::STATUS_EATEN;
        }
    }

    /**
     * Create random data for created_at field
     */
    public function setRandomCreatedAt(): void
    {
        $this->created_at = strtotime('-' . rand(0, 24) . 'hours');
    }

    /**
     * @throws Exception
     */
    public function randomStatus(): void
    {
        $this->status = $this->getRandomStatus();
        if ($this->isFall()){
            $this->setFallenAt();
            if ($this->canToRot()){
                $this->status = $this->getRandomStatus(true);
            }
        }
    }

    private function setFallenAt(): void
    {
        $this->fallen_at = rand($this->created_at, time());
    }

    /**
     * @param bool $canRoot
     * @return int
     */
    private function getRandomStatus(bool $canRoot = false): int
    {
        return array_rand(AppleHelper::statusListForRandom($canRoot));
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return Table::APPLES;
    }
}