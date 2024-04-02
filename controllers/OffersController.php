<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use app\models\Offers;
use app\models\OffersSearch;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OffersController implements the CRUD actions for Offers model.
 */
class OffersController extends Controller
{
    /**
     * @inheritDoc
     */
        public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // '@' oznacza, że użytkownik musi być zalogowany
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Lists all Offers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        $searchModel = new OffersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionTemplates()
    {
        $searchModel = new OffersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams,true);

        return $this->render('templates', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Offers model.
     * @param int $number Number
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($number)
    {
        $model = $this->findModel($number);
        if ($model->isTemplate()) {
            $model = $this->findModel($number);
            return $this->render('view_template', [
                'model' => $model,
            ]);
        }else{
            $dataProvider = $model->getOfferElements();
            return $this->render('view', [
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);

        }
    }

    /**
     * Creates a new Offers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($offer_template_number = null)
    {

        if ($offer_template_number != null) {
           
            $model = $this->useOfferTemplate($offer_template_number);
        }else{
            $model = new Offers();
        }
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->setIsNewRecord(true);
            $model->number = null;
            $model->is_template = 0;
            if ($model->save()) {
                return $this->redirect(['view', 'number' => $model->number]);
            }
        } else {
            $model->loadDefaultValues();
        }
        $dataProvider = Offers::getProductsTemplates();
        return $this->render('create', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }
    public function actionCreateTemplate()
    {
        $model = new Offers();
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->is_template = 1;
            if ( $model->save()) {
                return $this->redirect(['view', 'number' => $model->number]);
            } else {
                throw new NotFoundHttpException(var_dump($model->errors));
                
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create_template', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Offers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $number Number
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($number)
    {
        $model = $this->findModel($number);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'number' => $model->number]);
        }
            return $this->render($model->isTemplate() ? 'update_template':'update', [
                'model' => $model,
            ]);

    }

    /**
     * Deletes an existing Offers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $number Number
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($number)
    {
        $model = $this->findModel($number);
        $model->delete();
        return $this->redirect([$model->isTemplate() ?'templates': 'index']);
    }
    
    public function actionPdf($number)
    {
        $model = $this->findModel($number);
        $model->generatePdf();
    }



    /**
     * Finds the Offers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $number Number
     * @return Offers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($number)
    {
        if (($model = Offers::findOne(['number' => $number])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function useOfferTemplate($id)
    {
        if (($model = Offers::findOne(['number' => $id])) !== null) {
            if ($model->is_template == 1) {
                return $model;
            }
            throw new NotFoundHttpException('The requested product is not template.');
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
