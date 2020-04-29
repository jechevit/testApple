<?php

use core\entities\Apple;
use core\forms\AppleEatForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $item Apple */
/** @var $page int | null */
/** @var $model AppleEatForm */

$attributes = ['apple/eat', 'id' => $item->id];
if (isset($page)){
    $attributes = ArrayHelper::merge($attributes, ['page' => $page]);
}

Modal::begin([
    'header' => '<h2>Укажите сколько вы хотите съесть в %</h2>',
    'toggleButton' => [
        'label' => 'Откусить яблоко',
        'tag' => 'button',
        'class' => 'btn btn-success'
    ],
])?>
<?php $form = ActiveForm::begin([
    'id' => 'contact-form',
    'action' => $attributes
]); ?>

<?= $form->field($model, 'piece')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('КУСАЙ!', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php Modal::end()?>