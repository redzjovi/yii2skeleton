<?php

use common\models\Menu;
use slatiusa\nestable\Nestable;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Item'), ['item-create', 'parent_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reorder Items'), ['item-reorder', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'name',
            // 'parent_id',
            // 'lft',
            // 'rgt',
            // 'depth',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', ['/menu/item-view', 'id' => $model->id, 'parent_id' => $model->parent_id], ['class' => 'glyphicon glyphicon-eye-open']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('', ['/menu/item-update', 'id' => $model->id, 'parent_id' => $model->parent_id], ['class' => 'glyphicon glyphicon-pencil']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('', ['/menu/item-delete', 'id' => $model->id, 'parent_id' => $model->parent_id], [
                            'class' => 'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
