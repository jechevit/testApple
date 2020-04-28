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

             <?= Html::a('Сбросить яблоко', ['fall', 'id' => $item->id])?>

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

             <?= Html::a('Испортить яблоко', ['rot', 'id' => $item->id])?>
        </div>
        <?php endforeach;?>

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>