<?php

use common\models\User;
use common\models\WpCategories;
use common\models\WpTags;
use kartik\grid\GridView;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Wp Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wp-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wp Posts'), ['create'], ['class' => 'btn btn-success']) ?>
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
            ['attribute' => 'title', 'contentOptions' => ['class' => 'text-wrap'], 'vAlign' => 'middle'],
            [
                'attribute' => 'author',
                'filter' => ArrayHelper::map(User::find()->orderBy('email')->asArray()->all(), 'id', 'email'),
                'filterInputOptions' => ['placeholder' => ''],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
                'vAlign' => 'middle',
                'value' => function ($model) { return $model->user->email; }
            ],
            // 'name',
            // 'content:ntext',
            // 'type',
            // 'mime_type',
            // 'status',
            // 'created_at',
            [
                'attribute' => 'category_id',
                'filter' => Select2::widget([
                    'attribute' => 'category_id',
                    'data' => ArrayHelper::map(WpCategories::find()->select(['id', 'name'])->taxonomyCategory()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'),
                    'model' => $searchModel,
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ]),
                'format' => 'html',
                'label' => Yii::t('app', 'Category'),
                'vAlign' => 'middle',
                'value' => function ($model) {
                    $html = '';
                    foreach ($model->wpCategories as $wpCategory) {
                        $html .= ($html) ? ','.'<br />' : '';
                        $html .= Html::a($wpCategory->name, ['/wp-categories', 'WpCategoriesSearch[name]' => $wpCategory->name]);
                    }
                    return $html;
                },
            ],
            [
                'attribute' => 'tag_id',
                'filter' => Select2::widget([
                    'attribute' => 'tag_id',
                    'data' => ArrayHelper::map(WpTags::find()->select(['id', 'name'])->taxonomyTag()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', 'name'),
                    'model' => $searchModel,
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ]),
                'format' => 'html',
                'label' => Yii::t('app', 'Tag'),
                'vAlign' => 'middle',
                'value' => function ($model) {
                    $html = '';
                    foreach ($model->wpTags as $wpTag) {
                        $html .= ($html) ? ','.'<br />' : '';
                        $html .= Html::a($wpTag->name, ['/wp-tags', 'WpTagsSearch[name]' => $wpTag->name]);
                    }
                    return $html;
                },
            ],
            [
                'attribute' => 'updated_at',
                'filter' => DatePicker::widget([
                    'attribute' => 'updated_at_date',
                    'model' => $searchModel,
                    'pluginOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd'],
                ]),
                'vAlign' => 'middle',
            ],
            // 'comment_status',
            // 'comment_count',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
