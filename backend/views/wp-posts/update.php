<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WpPosts */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Wp Posts',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wp Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="wp-posts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
