<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Create Wp Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wp Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wp-term-taxonomy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
