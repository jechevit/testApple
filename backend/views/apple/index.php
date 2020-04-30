<?php

use backend\widgets\AppleButtonsPanel;
use core\entities\Apple;
use core\helpers\AppleHelper;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/** @var $dataProvider ActiveDataProvider */

$this->title = 'Яблоки';

if ($dataProvider->totalCount > 18){
    $pages = new Pagination(['totalCount' => $dataProvider->totalCount  , 'pageSize' => 18]);
}
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>

        <p >На этой странице вы сможете сгенерировать разное количество яблок от 1 до 100.
            Сорвать, испортить, съесть или выбросить.</p>

        <?= Html::a('Создать яблоко', ['apple/create'], ['class' => "btn btn-success"]) ?>
        <?= $this->render('_modal') ?>
    </div>

    <div class="body-content">
        <div class="row">
            <?php /** @var Apple $apple */
            foreach ($dataProvider->getModels() as $apple):?>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <p class="lead"><?= AppleHelper::statusName($apple->status) ?></p>
                    <p class="lead_info">Создано: <?= Yii::$app->formatter->asDatetime($apple->created_at, 'php:d.m.yy H:i:s') ?></p>
                    <?php if ($apple->isFall() || $apple->isRotten()):?>
                        <p class="lead_info">Упало: <?= Yii::$app->formatter->asDatetime($apple->fallen_at, 'php:d.m.yy H:i:s') ?></p>
                    <?php endif;?>
                    <div class="round <?= AppleHelper::colorName($apple->color)?>_round">
                        <?= $apple->eaten?>%
                    </div>
                    <?= AppleButtonsPanel::widget(['model' => $apple, 'form' => $model])?>
                </div>
            <?php endforeach;?>
        </div>
        <?php if (isset($pages)):?>
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        <?php endif;?>
    </div>
</div>