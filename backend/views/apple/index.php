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

$apples = array_chunk($dataProvider->getModels(), 6);

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

        <?php foreach ($apples as $row): ?>
        <div class="row">
            <?php /** @var Apple $item */
            foreach ($row as $item):?>
                <div class="col-lg-2">
                    <div class="<?= AppleHelper::colorName($item->color)?>_round"><?= $item->eaten?>%</div>
                    <?= '<p class="lead">' . AppleHelper::statusName($item->status) . '</p>'?>

                    <?= AppleButtonsPanel::widget(['model' => $item, 'form' => $model])?>
                </div>
            <?php endforeach;?>
        </div>
        <?php endforeach;?>

        <?php if (isset($pages)):?>
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        <?php endif;?>
    </div>
</div>