<?php

namespace core\helpers;

use core\entities\Apple;
use yii\helpers\ArrayHelper;

class AppleHelper
{
    /**
     * @return array|string[]
     */
    public static function colorList(): array
    {
        return [
            Apple::COLOR_GREEN => 'green',
            Apple::COLOR_RED => 'red',
            Apple::COLOR_YELLOW => 'yellow',
        ];
    }

    /**
     * @param $color
     * @return string
     */
    public static function colorName($color): string
    {
        return ArrayHelper::getValue(self::colorList(), $color);
    }

    /**
     * @return string[]
     */
    public static function statusList()
    {
        return [
            Apple::STATUS_ON_TREE => 'на дереве',
            Apple::STATUS_IS_FALLEN => 'на земле',
            Apple::STATUS_ROTTEN => 'испорчено',
            Apple::STATUS_EATEN => 'съедено',
        ];
    }

    /**
     * @param bool $canRoot
     * @return array|string[]
     */
    public static function statusListForRandom(bool $canRoot = false): array
    {
        if ($canRoot) {
            return [
                Apple::STATUS_ROTTEN => 'испорчено',
                Apple::STATUS_IS_FALLEN => 'на земле',
            ];
        }
        return [
            Apple::STATUS_ON_TREE => 'на дереве',
            Apple::STATUS_IS_FALLEN => 'на земле',
        ];
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }
}