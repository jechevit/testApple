<?php


namespace core\forms;

use yii\base\Model;

class AppleEatForm extends Model
{
    public $piece;

    public function rules()
    {
        return [
            ['piece', 'required'],
            ['piece', 'integer', 'min' => 0, 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'piece' => 'Кусочек',
        ];
    }
}