<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wp Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wp-posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            ['attribute' => 'author', 'value' => $model->user->email],
            'title:ntext',
            'name',
            'content:ntext',
            // 'type',
            // 'mime_type',
            ['attribute' => 'status', 'value' => $model->statusOptions[$model->status]],
            'created_at',
            'updated_at',
            ['attribute' => 'comment_status', 'value' => $model->commentStatusOptions[$model->comment_status]],
            // 'comment_count',
        ],
    ]) ?>

</div>
