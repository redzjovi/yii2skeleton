<?php

use common\models\User;
use kartik\grid\GridView;
use kartik\widgets\DatePicker;
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
            ['attribute' => 'title', 'contentOptions' => ['class' => 'text-wrap']],
            [
                'attribute' => 'author',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(User::find()->orderBy('email')->asArray()->all(), 'id', 'email'),
                'filterInputOptions' => ['placeholder' => ''],
                'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
                'value' => function ($model) { return $model->user->email; }
            ],
            // 'name',
            // 'content:ntext',
            // 'type',
            // 'mime_type',
            // 'status',
            // 'created_at',
            [
                'attribute' => 'updated_at',
                'filter' => DatePicker::widget([
                    'attribute' => 'updated_at_date',
                    'model' => $searchModel,
                    'pluginOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd'],
                ]),
            ],
            // 'comment_status',
            // 'comment_count',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
