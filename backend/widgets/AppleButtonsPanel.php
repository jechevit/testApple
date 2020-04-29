<?php

namespace backend\widgets;

use core\entities\Apple;
use core\forms\AppleEatForm;
use yii\base\Widget;
use yii\helpers\Html;

class AppleButtonsPanel extends Widget
{
    /**
     * @var Apple
     */
    public $model;

    /**
     * @var AppleEatForm
     */
    public $form;

    /**
     * @var string[]
     */
    public $defaultOptions = ['class' => 'btn btn-primary'];

    /**
     * @var mixed|string
     */
    private $panel = '';

    public function init()
    {
        $this->populatePanel();
    }

    public function run()
    {
        return $this->panel;
    }

    private function populatePanel()
    {
        if ($this->model->isOnTree()){
            $this->getOnTreePanel();
        }
        if ($this->model->isFall()){
            $this->getFallPanel();
        }
        if ($this->model->isRotten()){
            $this->getRottenPanel();
        }
    }

    private function getOnTreePanel()
    {
        $this->panel .= Html::a('Сорвать', ['fall', 'id' => $this->model->id], $this->defaultOptions);
    }

    private function getFallPanel()
    {
        $this->panel .= $this->render('modal', ['item' => $this->model, 'model' => $this->form]);
        $this->panel .= Html::a('Испортить', ['rot', 'id' => $this->model->id], $this->defaultOptions);
    }

    private function getRottenPanel()
    {
        $this->panel .= Html::a('Выбросить', ['delete', 'id' => $this->model->id], $this->defaultOptions);
    }
}