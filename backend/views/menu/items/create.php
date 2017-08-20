<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Create Menu Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $menu->name, 'url' => ['view', 'id' => $menu->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('/menu/items/_form', [
        'model' => $model,
        'menu' => $menu,
    ]) ?>

</div>
