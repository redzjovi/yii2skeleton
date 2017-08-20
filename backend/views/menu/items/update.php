<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Menu',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parent->name, 'url' => ['view', 'id' => $model->parent_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['item-view', 'id' => $model->id, 'parent_id' => $model->parent_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
