<?php

namespace backend\controllers;

use backend\forms\AppleSearch;
use core\entities\Apple;
use core\forms\AppleCreateForm;
use core\services\AppleService;
use DomainException;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AppleController extends Controller
{
    /**
     * @var AppleService
     */
    private $appleService;

    public function __construct($id, $module, AppleService $appleService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->appleService = $appleService;
    }

    public function actionIndex()
    {
        $searchModel = new AppleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        return $this->render('view', [
            'apple' => $this->findModel($id),
        ]);

    }

    public function actionCreate()
    {
        $form = new AppleCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $action = $this->appleService->create($form);
                return $this->redirect(['index']);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionFall(int $id)
    {
        try {
            $this->appleService->fall($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function actionRot(int $id)
    {
        try {
            $this->appleService->rot($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionDelete(int $id)
    {
        try {
            $this->appleService->remove($id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Apple|null the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apple::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}