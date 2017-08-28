<?php

namespace backend\controllers;

use Yii;
use common\models\ProductImages;
use common\models\Products;
use backend\models\ProductsForm;
use backend\models\ProductsSearch;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    ['actions' => ['create', 'delete', 'image-delete', 'image-upload', 'index', 'update', 'view'], 'allow' => true, 'roles' => ['backend.products']],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember('', 'backend_products');

        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products(['scenario' => 'backend_products']);
        $productImagesModel = new ProductImages();
        $productsForm = new ProductsForm();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            $isValid = $model->validate();

            $productsForm->load(Yii::$app->request->post());

            if ($isValid) {
                $model->save();

                $productsForm->product_id = $model->getPrimaryKey();
                $productsForm->upload();

                return $this->redirect(
                    Url::previous('backend_products') ? Url::previous('backend_products') : ['/products']
                );
            }
        }

        return $this->render('create', [
            'model' => $model,
            'productImagesModel' => $productImagesModel,
            'productsForm' => $productsForm,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $productImagesModel = ProductImages::find()->where(['product_id' => $id])->orderBy('position')->all();
        $productsForm = new ProductsForm();

        $model = $this->findModel($id);
        $model->scenario = 'backend_products';

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            $isValid = $model->validate();

            $productsForm->load(Yii::$app->request->post());
            $productsForm->product_id = $id;
            $isValid = $productsForm->validate() && $isValid;

            if ($isValid) {
                $model->save();

                $productsForm->upload();

                return $this->redirect(
                    Url::previous('backend_products') ? Url::previous('backend_products') : ['/products']
                );
            }
        }

        return $this->render('update', [
            'model' => $model,
            'productImagesModel' => $productImagesModel,
            'productsForm' => $productsForm,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        ProductImages::deleteAll(['product_id' => $id]);
        FileHelper::removeDirectory('uploads/products/'.$id);
        $this->findModel($id)->delete();

        return $this->redirect(
            Url::previous('backend_products') ? Url::previous('backend_products') : ['index']
        );
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImageUpload()
    {
        $productsForm = new ProductsForm();

        if (Yii::$app->request->isPost) {
            $files = UploadedFile::getInstances($productsForm, 'product_images_array');
            $response = [];

            foreach ($files as $file) {
                $time = time();
                $path = 'uploads/temp/' . $time;

                FileHelper::createDirectory($path, $mode = 0755, $recursive = true);

                if ($file->saveAs($path . '/' . $file->baseName . '.' . $file->extension)) {
                    $response['initialPreview'][] = Html::img(
                        Url::to('@web'. '/'. $path . '/' . $file->baseName . '.' . $file->extension),
                        [
                            'alt' => $file->baseName . '.' .$file->extension,
                            'class' => 'file-preview-image',
                            'title' => $file->baseName . '.' .$file->extension,
                            'style' => 'height: inherit; width: inherit;',
                        ]
                    )
                    .Html::activeHiddenInput(
                        $productsForm,
                        'product_images[]',
                        ['value' => $path . '/' . $file->baseName . '.' . $file->extension]
                    );

                    $response['initialPreviewConfig'][] = [
                        'caption' => $file->baseName . '.' .$file->extension,
                        'extra' => ['type' => 'temp'],
                        'key' => $time,
                        'size' => $file->size,
                        'url' => Url::to('@web/products/image-delete'),
                    ];
                }
            }

            echo Json::encode($response);
        }
    }

    public function actionImageDelete()
    {
        if (Yii::$app->request->isPost) {
            $type = Yii::$app->request->post('type');
            $key = Yii::$app->request->post('key');

            if ($type == 'temp') {
                $path = 'uploads/temp/' . $key;
            }

            FileHelper::removeDirectory($path, $mode = 0755, $recursive = true);
            echo Json::encode([]);
        }
    }
}
