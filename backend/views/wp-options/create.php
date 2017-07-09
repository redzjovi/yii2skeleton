<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WpOptions */

$this->title = Yii::t('app', 'Create Wp Options');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wp Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wp-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
