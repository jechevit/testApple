<?php

use core\entities\Apple;
use core\helpers\AppleHelper;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/** @var $dataProvider ActiveDataProvider */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <?= Html::a('Создать яблоко', ['apple/create'], ['class' => "btn btn-success"]) ?>
    </div>

    <div class="body-content">

        <?php /** @var Apple $item */
        foreach ($dataProvider->getModels() as $item): ?>
        <div class="col-lg-2">
             <?= '<p class="lead">' . AppleHelper::colorName($item->color) . '</p>'?>
             <?= '<p>' . AppleHelper::statusName($item->status) . '</p>'?>
             <?= '<p>' . $item->eaten . '</p>'?>

             <?= Html::a('Сбросить яблоко', ['fall', 'id' => $item->id], ['class' => 'btn btn-success']) ?>

             <?php Modal::begin([
                    'header' => '<h2>Hello world</h2>',
                    'toggleButton' => [
                        'label' => 'Откусить яблоко',
                        'tag' => 'button',
                        'class' => 'btn btn-success'
                    ],
                    'footer' => 'Низ окна',
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

             <?= Html::a('Испортить яблоко', ['rot', 'id' => $item->id], ['class' => 'btn btn-success'])?>
        </div>
        <?php endforeach;?>

    </div>
</div>