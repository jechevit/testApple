<?php


namespace core\forms;


use yii\base\Model;

class GenerateForm extends Model
{
    public $quantity;

    public function rules()
    {
        return [
            ['quantity', 'required'],
            ['quantity', 'integer', 'min' => 0, 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'quantity' => 'Количество',
        ];
    }
}