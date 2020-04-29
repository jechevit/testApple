<?php


namespace core\forms;

use yii\base\Model;

class AppleEatForm extends Model
{
    public $piece;

    public function rules()
    {
        return [
            ['piece', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'piece' => 'Кусочек',
        ];
    }
}