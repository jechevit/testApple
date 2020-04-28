<?php

namespace core\forms;

use yii\base\Model;

class AppleCreateForm extends Model
{
    public $color;

    public function rules()
    {
        return [
            ['color', 'string']
        ];
    }
}