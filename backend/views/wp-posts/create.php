<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WpPosts */

$this->title = Yii::t('app', 'Create Wp Posts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wp Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wp-posts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
