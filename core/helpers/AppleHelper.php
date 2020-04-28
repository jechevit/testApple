<?php

namespace core\helpers;

use core\entities\Apple;
use yii\helpers\ArrayHelper;

class AppleHelper
{
    public static function colorList(): array
    {
        return [
            Apple::COLOR_GREEN => 'green',
            Apple::COLOR_RED => 'red',
            Apple::COLOR_YELLOW => 'yellow',
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
            Apple::STATUS_EATEN => 'съедено',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }
}