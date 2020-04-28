<?php

use core\forms\AppleCreateForm;

/* @var $this yii\web\View */
/* @var $apple AppleCreateForm */

$this->title = 'Инфа о яблоке';
$this->params['breadcrumbs'][] = ['label' => 'Яблоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-tabs-custom">
    <div class="tab-content">

        <div class="row">
            <div class="col-md-10">
                <?= $apple->color ?>
            </div>
        </div>

    </div>
</div>
