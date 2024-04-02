<?php

namespace app\controllers;

use yii\filters\AccessControl;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams,true);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
     
        //  throw new NotFoundHttpException(base64_encode($model->photo));
//WnJ6dXQgZWtyYW51IDIwMjQtMDMtMjQgMTYzNTU5LnBuZw==
        if ($model->isTemplate()) {
            return $this->render('view_template', [
                'model' => $model,
            ]);
        }else{
            return $this->render('view_offer_element', [
                'model' => $model,
                'offer_number' => $model->offer_number,
            ]);
        }

    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateTemplate()
    {
        $model = new Products();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $uploadetPhoto = UploadedFile::getInstance($model, 'photo');
            // throw new NotFoundHttpException(  $this->request->post('template_photo') );
            $model->photo = $uploadetPhoto ? file_get_contents($uploadetPhoto->tempName) : base64_decode($this->request->post('template_photo'));
            $model->setIsNewRecord(true);
            $model->id = null;
            $model->is_template = 1;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create_template', [
            'model' => $model,
        ]);
    }

    public function actionCreateOfferElement($offer_number,$product_template_id = null)
    {
        if ($product_template_id != null) {
         
            $model = $this->useProductTemplate($product_template_id);
        }else{
            $model = new Products();
        }

        $model->offer_number = $offer_number;
        
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $uploadetPhoto = UploadedFile::getInstance($model, 'photo');
            // throw new NotFoundHttpException(  $this->request->post('template_photo') );
            $model->photo = $uploadetPhoto ? file_get_contents($uploadetPhoto->tempName) : base64_decode($this->request->post('template_photo'));
            $model->setIsNewRecord(true);
            $model->id = null;

            $model->is_template = 0;
            if ($model->save()) {
                // $photo = UploadedFile::getInstance($model, 'file');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $dataProvider = Products::getProductsTemplates();

        return $this->render('create_offer_element', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost ) {
            $model->load($this->request->post());
            
     
            $uploadetPhoto = UploadedFile::getInstance($model, 'photo');
            $model->photo = $uploadetPhoto ? file_get_contents($uploadetPhoto->tempName) : base64_decode($this->request->post('template_photo'));
            // $model->setIsNewRecord(false);
            // throw new NotFoundHttpException( $model->height);
            if ( $model->save()) {
               
            return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        if ($model->isTemplate()) {
            return $this->render('update_template', [
                'model' => $model,
            ]);
        }else{
            return $this->render('update_offer_element', [
                'model' => $model,
                'offer_number' => $model->offer_number,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        if ($model->isTemplate()) {
            return $this->redirect(['index']);
        }
        return $this->redirect(['offers/view','number'=>$model->offer_number]);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function useProductTemplate($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            if ($model->is_template == 1) {
                return $model;
            }
            throw new NotFoundHttpException('The requested product is not template.');
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
