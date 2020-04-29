<?php

use core\entities\Apple;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $item Apple */

Modal::begin([
    'header' => '<h2>Hello world</h2>',
    'toggleButton' => [
        'label' => 'Откусить яблоко',
        'tag' => 'button',
        'class' => 'btn btn-success'
    ],
])?>
<?php $form = ActiveForm::begin([
    'id' => 'contact-form',
    'action' => ['apple/eat', 'id' => $item->id]
]); ?>

<?= $form->field($model, 'piece')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('КУСАЙ!', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php Modal::end()?>