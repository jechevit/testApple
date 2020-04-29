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

$this->title = 'My Yii Application';

if ($dataProvider->totalCount > 18){
    $pages = new Pagination(['totalCount' => $dataProvider->totalCount  , 'pageSize' => 18]);
}
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <?= Html::a('Создать яблоко', ['apple/create'], ['class' => "btn btn-success"]) ?>
        <?= Html::a('Сгенерировать', ['apple/generate'], ['class' => "btn btn-success"]) ?>
    </div>

    <div class="body-content">
        <div class="row">
            <?php /** @var Apple $apple */
            foreach ($dataProvider->getModels() as $apple):?>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <p class="lead"><?= AppleHelper::statusName($apple->status) ?></p>
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