<?php

use core\forms\GenerateForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

Modal::begin([
    'header' => '<h2>Укажите сколько яблок сгенерировать</h2>',
    'toggleButton' => [
        'label' => 'Сгенерировать',
        'tag' => 'button',
        'class' => 'btn btn-success'
    ],
]);

$model = new GenerateForm();
?>
<?php $form = ActiveForm::begin([
    'id' => 'contact-form',
    'action' => ['apple/generate']
]); ?>

<?= $form->field($model, 'quantity')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сгенерировать!', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php Modal::end() ?>