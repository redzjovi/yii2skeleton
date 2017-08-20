<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $kartikGrid = Yii::$app->params['kartikGrid'];
    $kartikGrid['panel'] = false; ?>
    <?= GridView::widget($kartikGrid + [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            'name',
            // 'link',
            // 'auth_item_name',
            // 'parent_id',
            // 'lft',
            // 'rgt',
            // 'depth',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
