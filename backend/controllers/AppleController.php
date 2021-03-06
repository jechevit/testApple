<?php

namespace backend\controllers;

use backend\forms\AppleSearch;
use core\entities\Apple;
use core\forms\AppleCreateForm;
use core\forms\AppleEatForm;
use core\services\AppleService;
use DomainException;
use Exception;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class AppleController
 * @package backend\controllers
 */
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

    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['accessPanel'],
                    ]
                ]
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new AppleEatForm();
        $searchModel = new AppleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        return $this->render('view', [
            'apple' => $this->findModel($id),
        ]);
    }

    /**
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $form = new AppleCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->appleService->create($form);
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

    /**
     * @return Response
     * @throws Exception
     */
    public function actionGenerate()
    {
        if (!isset(Yii::$app->request->bodyParams['GenerateForm']['quantity'])){
            return $this->redirect(['index']);
        }

        $quantity = Yii::$app->request->bodyParams['GenerateForm']['quantity'];
        try {
            $this->appleService->generate($quantity);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @param int|null $page
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionFall(int $id, int $page = null)
    {
        $apple = $this->findModel($id);
        try {
            $this->appleService->fall($apple->id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect($this->getAttributes($page));
    }

    /**
     * @param int|null $page
     * @return array|string[]
     */
    public function getAttributes(int $page = null)
    {
        $attribute = ['index'];
        if (isset($page)){
            $attribute = ArrayHelper::merge($attribute, ['page' => $page]);
        }
        return $attribute;
    }

    /**
     * @param int $id
     * @param int $page
     * @return Response
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionRot(int $id, int $page = null)
    {
        $apple = $this->findModel($id);
        try {
            $this->appleService->rot($apple->id);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect($this->getAttributes($page));
    }

    /**
     * @param int $id
     * @param int|null $page
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionEat(int $id, int $page = null)
    {
        $apple = $this->findModel($id);

        if (!isset(Yii::$app->request->bodyParams['AppleEatForm']['piece'])){
            return $this->redirect(['index']);
        }
        $piece = intval(Yii::$app->request->bodyParams['AppleEatForm']['piece']);

        try {
            $this->appleService->eat($apple->id, $piece);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect($this->getAttributes($page));
    }

    /**
     * @param int $id
     * @return Response
     * @throws \Throwable
     * @throws StaleObjectException
     */
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
     * Finds the Apple model based on its primary key value.
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