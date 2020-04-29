<?php

use backend\widgets\AppleButtonsPanel;
use core\entities\Apple;
use core\helpers\AppleHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

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
            <div class="<?= AppleHelper::colorName($item->color)?>_round"><?= $item->eaten?>%</div>

            <?= '<p class="lead">' . AppleHelper::statusName($item->status) . '</p>'?>

            <?= AppleButtonsPanel::widget(['model' => $item, 'form' => $model])?>

        </div>
        <?php endforeach;?>

    </div>
</div>