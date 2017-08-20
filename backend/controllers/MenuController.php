<?php

namespace backend\controllers;

use common\models\Menu;
use backend\models\MenuSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
{
    public function actions()
    {
        return [
            'nodeMove' => [
                'class' => 'slatiusa\nestable\NodeMoveAction',
                'modelName' => Menu::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    ['actions' => ['create', 'delete', 'index', 'item-create', 'item-delete', 'item-update', 'item-reorder', 'item-view', 'update', 'view'], 'allow' => true, 'roles' => ['backend/menu']],
                    ['allow' => true, 'roles' => ['@']],
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember('', 'backend_menu');

        $searchModel = new MenuSearch();
        $searchModel->parent_id = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['name' => SORT_ASC]]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new MenuSearch();
        $searchModel->parent_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['lft' => SORT_ASC]]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu(['scenario' => Menu::SCENARIO_CREATE_MENU]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $root = Menu::find()->roots()->one();
            $model->parent_id = $root->id;
            $model->prependTo($root);

            return $this->redirect(
                Url::previous('backend_menu') ? Url::previous('backend_menu') : ['/menu']
            );
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Menu::SCENARIO_CREATE_MENU;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(
                Url::previous('backend_menu') ? Url::previous('backend_menu') : ['/menu']
            );
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Menu::deleteAll(['parent_id' => $id]);

        return $this->redirect(
            Url::previous('backend_menu') ? Url::previous('backend_menu') : ['/menu']
        );
    }

    public function actionItemCreate($parent_id)
    {
        $menu = $this->findModel($parent_id);
        $model = new Menu(['scenario' => Menu::SCENARIO_CREATE_MENU_ITEM]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->prependTo($menu);

            return $this->redirect(['/menu/view', 'id' => $menu->id]);
        } else {
            return $this->render('/menu/items/create', [
                'model' => $model,
                'menu' => $menu,
            ]);
        }
    }

    public function actionItemDelete($id, $parent_id = 0)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/menu/view', 'id' => $parent_id]);
    }

    public function actionItemUpdate($id, $parent_id)
    {
        $model = $this->findModel($id);
        $model->scenario = Menu::SCENARIO_CREATE_MENU_ITEM;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/menu/view', 'id' => $parent_id]);
        } else {
            return $this->render('/menu/items/update', [
                'model' => $model,
            ]);
        }
    }

    public function actionItemReorder($id)
    {
        $model = $this->findModel($id);
        return $this->render('/menu/items/reorder', [
            'model' => $model,
        ]);
    }

    public function actionItemView($id)
    {
        return $this->render('/menu/items/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
