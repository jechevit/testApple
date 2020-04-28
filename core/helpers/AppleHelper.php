<?php

namespace core\helpers;

use core\entities\Apple;
use yii\helpers\ArrayHelper;

class AppleHelper
{
    public static function colorList(): array
    {
        return [
            Apple::COLOR_GREEN => 'зеленое',
            Apple::COLOR_RED => 'красное',
            Apple::COLOR_YELLOW => 'желтое',
        ];
    }

    public static function colorName($color): string
    {
        return ArrayHelper::getValue(self::colorList(), $color);
    }

    public static function statusList()
    {
        return [
            Apple::STATUS_ON_TREE => 'на дереве',
            Apple::STATUS_IS_FALLEN => 'на земле',
            Apple::STATUS_ROTTEN => 'испорчено',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }
}