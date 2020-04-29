<?php

namespace backend\widgets;

use core\entities\Apple;
use core\forms\AppleEatForm;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
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
     * @var array
     */
    public $defaultOptions = ['class' => 'btn btn-primary'];
    public $deleteOptions = [
        'class' => 'btn btn-primary',
        'data-method' => 'post',
    ];

    /**
     * @var mixed|string
     */
    private $panel = '';
    /**
     * @var mixed
     */
    private $paginator;

    public function init()
    {
        $this->paginator = $this->setPage();
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
        $this->panel .= $this->renderButton('Сорвать', 'fall');
    }

    private function getFallPanel()
    {

        $this->panel .= $this->render('modal', [
            'item' => $this->model,
            'model' => $this->form,
            'page' => isset($this->paginator) ? $this->paginator : null,
        ]);
        $this->panel .= $this->renderButton('Испортить', 'rot');
    }

    private function getRottenPanel()
    {
        $this->panel .= $this->renderButton('Выбросить', 'delete', true);
    }

    private function renderButton(string $title, string $url, $options = false)
    {
        $url = [$url, 'id' => $this->model->id];

        if (isset($this->paginator)){
            $url = ArrayHelper::merge($url, ['page' => $this->paginator]);
        }

        return Html::a($title, $url, isset($options) ? $this->deleteOptions : $this->defaultOptions
        );
    }

    private function setPage()
    {
        if (isset(Yii::$app->request->queryParams['page'])){
            return Yii::$app->request->queryParams['page'];
        }
        return null;
    }
}