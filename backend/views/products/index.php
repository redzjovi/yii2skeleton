<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Products'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'condensed' => true,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'hover' => true,
        'panel' => ['footer' => false, 'type' => GridView::TYPE_DEFAULT],
        'pjax' => true,
        'resizableColumns' => true,
        'responsiveWrap' => false,
        'showPageSummary' => true,
        'toolbar'=> [
            [
                'content' => Html::a(
                    '<i class="glyphicon glyphicon-repeat"></i>',
                    [''],
                    ['class' => 'btn btn-default', 'data-pjax' => 1, 'title' => Yii::t('kvgrid', 'Reset Grid')]
                )
            ],
            // '{export}',
            '{toggleData}',
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['attribute' => 'product_name'],
            // 'description:ntext',
            ['attribute' => 'weight', 'format' => 'decimal', 'hAlign' => 'right'],
            ['attribute' => 'sell_price', 'format' => 'decimal', 'hAlign' => 'right'],
            ['attribute' => 'stock', 'format' => 'decimal', 'hAlign' => 'right', 'pageSummary' => true],
            ['attribute' => 'status', 'class' => 'kartik\grid\BooleanColumn', 'vAlign' => 'middle'],
            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
