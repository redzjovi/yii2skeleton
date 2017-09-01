<?php

// use common\models\WpTags;
use kartik\grid\GridView;
// use kartik\widgets\Select2;
// use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Wp Tags');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wp-term-taxonomy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wp Tag'), ['create'], ['class' => 'btn btn-success']) ?>
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
            // [
            //     'attribute' => 'name',
            //     'filter' => Select2::widget([
            //         'attribute' => 'name',
            //         'data' => ArrayHelper::map(WpTags::find()->select(['id', 'name'])->taxonomyTag()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'name', 'name'),
            //         'model' => $searchModel,
            //         'options' => ['placeholder' => ''],
            //         'pluginOptions' => ['allowClear' => true],
            //     ]),
            // ],
            'slug',
            // 'taxonomy',
            ['attribute' => 'description', 'contentOptions' => ['class' => 'text-wrap']],
            // 'parent',
            'count',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
