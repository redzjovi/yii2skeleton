<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WpPostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wp Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wp-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wp Posts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'author',
            'title:ntext',
            'name',
            'content:ntext',
            // 'type',
            // 'mime_type',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'comment_status',
            // 'comment_count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
