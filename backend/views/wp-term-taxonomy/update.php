<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WpTermTaxonomy */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Wp Term Taxonomy',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wp Term Taxonomies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="wp-term-taxonomy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
