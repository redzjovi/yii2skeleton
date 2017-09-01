<?php

namespace backend\controllers;

use backend\models\WpPostsSearch;
use common\models\WpCategories;
use common\models\WpPosts;
use common\models\WpTags;
use common\models\WpTermRelationships;
use common\models\WpTermTaxonomy;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * WpPostsController implements the CRUD actions for WpPosts model.
 */
class WpPostsController extends Controller
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
                    ['actions' => ['create', 'delete', 'index', 'update', 'view'], 'allow' => true, 'roles' => ['backend.wp-posts']],
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
     * Lists all WpPosts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WpPostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WpPosts model.
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
     * Creates a new WpPosts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WpPosts(['scenario' => 'backend.wp-posts']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $WpCategories = new WpCategories();
            $term_taxonomies = $WpCategories->selectCategories($model->categories);
            $WpTermRelationships = new WpTermRelationships();
            $WpTermRelationships->createWpTermRelationships($model->id, $term_taxonomies, 'category');

            $WpTags = new WpTags();
            $term_taxonomies = $WpTags->createTags($model->tags);
            $WpTermRelationships = new WpTermRelationships();
            $WpTermRelationships->createWpTermRelationships($model->id, $term_taxonomies, 'tag');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WpPosts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'backend.wp-posts';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $WpCategories = new WpCategories();
            $term_taxonomies = $WpCategories->selectCategories($model->categories);
            $WpTermRelationships = new WpTermRelationships();
            $WpTermRelationships->createWpTermRelationships($model->id, $term_taxonomies, 'category');

            $WpTags = new WpTags();
            $term_taxonomies = $WpTags->createTags($model->tags);
            $WpTermRelationships = new WpTermRelationships();
            $WpTermRelationships->createWpTermRelationships($model->id, $term_taxonomies, 'tag');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WpPosts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        foreach ($model->wpTermRelationships as $WpTermRelationship) {
            $WpTermRelationship->delete();

            $WpTermTaxonomy = new WpTermTaxonomy();
            $WpTermTaxonomy->calculateCount($WpTermRelationship->term_taxonomy_id);
        }

        $model->delete();
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the WpPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WpPosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WpPosts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
