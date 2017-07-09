<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WpOptions */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Wp Options',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wp Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="wp-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
