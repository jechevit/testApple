<?php

use core\forms\AppleCreateForm;
use core\helpers\AppleHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model AppleCreateForm */

$this->title = 'Создание яблока';
$this->params['breadcrumbs'][] = ['label' => 'Яблоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-tabs-custom">
    <div class="tab-content">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype'=>'multipart/form-data']
        ]); ?>

        <div class="row">
            <div class="col-md-10">
                <?= $form->field($model, 'color')->dropDownList(AppleHelper::colorList())->label('Выберите цвет') ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
