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
}