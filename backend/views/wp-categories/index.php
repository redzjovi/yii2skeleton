<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Wp Categories');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wp-term-taxonomy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wp Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $kartikGrid = Yii::$app->params['kartikGrid'];
    $kartikGrid['toolbar'] = [
        ['content' => Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['class' => 'btn btn-default', 'data-pjax' => 1, 'title' => Yii::t('kvgrid', 'Reset Grid')])],
        '{toggleData}',
    ];
    $kartikGrid['pjax'] = false; ?>
    <?= GridView::widget($kartikGrid + [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            'name',
            'slug',
            // 'taxonomy',
            ['attribute' => 'description', 'contentOptions' => ['class' => 'text-wrap']],
            // 'parent',
            'count',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
