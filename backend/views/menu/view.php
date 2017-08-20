<?php

use kartik\grid\GridView;
use yii\helpers\Html;

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

    <?php $kartikGrid = Yii::$app->params['kartikGrid'];
    $kartikGrid['toolbar'] = [
        ['content' => Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/menu/view', 'id' => $model->id], ['class' => 'btn btn-default', 'data-pjax' => 1, 'title' => Yii::t('kvgrid', 'Reset Grid')])],
        '{toggleData}',
    ]; ?>
    <?= GridView::widget($kartikGrid + [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            // 'id',
            'name',
            // 'link',
            ['attribute' => 'link', 'contentOptions' => ['class' => 'text-wrap', 'style' => '']],
            'auth_item_name',
            // 'parent_id',
            // 'lft',
            // 'rgt',
            // 'depth',
            [
                'class' => 'kartik\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', ['/menu/item-view', 'id' => $model->id, 'parent_id' => $model->parent_id], ['class' => 'glyphicon glyphicon-eye-open', 'data-pjax' => 0]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('', ['/menu/item-update', 'id' => $model->id, 'parent_id' => $model->parent_id], ['class' => 'glyphicon glyphicon-pencil', 'data-pjax' => 0]);
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
