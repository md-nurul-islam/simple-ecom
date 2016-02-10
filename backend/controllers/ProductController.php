<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\ProductCategory;
use common\models\Category;
use common\models\UploadForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Product();
        $model_category = new Category();
        $model_product_category = new ProductCategory();
        $upload_model = new UploadForm;

        if (isset($_POST['Product']) && !empty($_POST['Product'])) {

            $model->attributes = $_POST['Product'];
            $model->beforeSave(TRUE);

            if ($model->validate()) {

                if (empty($_POST['ProductCategory']['category_id'])) {
                    $model_product_category->addError('category_id', 'No category selected.');
                } else {

                    foreach ($_POST['ProductCategory']['category_id'] as $category) {
                        $model_product_category = new ProductCategory();
                        $model_product_category->product_id = $model->id;
                        $model_product_category->category_id = $category;
                    }
                }
                
                $upload_model->imageFiles = UploadedFile::getInstances($upload_model, 'imageFiles');
                $uploaded_files = $upload_model->upload();
                if (!empty($uploaded_files)) {
                    
                }
                
            } else {
                var_dump($model->errors);
            }

            var_dump($_POST);
            exit;
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'model_category' => $model_category,
                        'model_product_category' => $model_product_category,
                        'upload_model' => $upload_model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {



            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
