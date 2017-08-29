<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WpTermTaxonomy */

$this->title = Yii::t('app', 'Create Wp Term Taxonomy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wp Term Taxonomies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wp-term-taxonomy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
